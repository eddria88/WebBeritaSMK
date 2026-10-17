<?php

namespace Tests\Feature;

use App\Models\Informasi;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteInformasiSekolahTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Skenario 1: Buka halaman admin tanpa login diarahkan ke login.
     */
    public function test_guest_is_redirected_to_login_from_admin_page(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Skenario 2: Login sebagai user/siswa, buka URL admin dialihkan ke halaman informasi.
     */
    public function test_user_cannot_access_admin_pages(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertRedirect(route('informasi.index'));
        $response->assertSessionHas('error');
    }

    /**
     * Skenario 3: Login sebagai admin masuk ke dashboard admin.
     */
    public function test_admin_login_redirects_to_dashboard(): void
    {
        User::factory()->admin()->create([
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response = $this->post(route('login.post'), [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    /**
     * Skenario 4: Login sebagai user masuk ke halaman informasi.
     */
    public function test_user_login_redirects_to_informasi(): void
    {
        User::factory()->create([
            'username' => 'siswa1',
            'password' => 'siswa123',
            'role' => 'user',
        ]);

        $response = $this->post(route('login.post'), [
            'username' => 'siswa1',
            'password' => 'siswa123',
        ]);

        $response->assertRedirect(route('informasi.index'));
        $this->assertAuthenticated();
    }

    /**
     * Skenario 5: User mencoba menghapus data informasi ditolak.
     */
    public function test_user_cannot_delete_informasi(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create(['role' => 'user']);

        $info = Informasi::create([
            'judul' => 'Info Penting',
            'isi' => 'Isi info',
            'kategori' => 'Pengumuman',
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($user)->delete(route('admin.informasi.destroy', $info));

        $response->assertRedirect(route('informasi.index'));
        $this->assertDatabaseHas('informasi', ['id' => $info->id]);
    }

    /**
     * Skenario 6: Admin menambah informasi dan tampil di halaman user.
     */
    public function test_admin_can_create_informasi(): void
    {
        $admin = User::factory()->admin()->create();

        $data = [
            'judul' => 'Lomba Desain Poster RPL',
            'kategori' => 'Kegiatan',
            'isi' => 'Ikuti lomba poster digital jurusan RPL berhadiah menarik.',
        ];

        $response = $this->actingAs($admin)->post(route('admin.informasi.store'), $data);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas('informasi', ['judul' => 'Lomba Desain Poster RPL']);

        // Pastikan tampil saat diakses user
        $user = User::factory()->create(['role' => 'user']);
        $userResponse = $this->actingAs($user)->get(route('informasi.index'));
        $userResponse->assertSee('Lomba Desain Poster RPL');
    }

    /**
     * Skenario 7: Admin mengubah informasi dan data terbarui.
     */
    public function test_admin_can_update_informasi(): void
    {
        $admin = User::factory()->admin()->create();

        $info = Informasi::create([
            'judul' => 'Judul Lama',
            'kategori' => 'Akademik',
            'isi' => 'Isi lama',
            'user_id' => $admin->id,
        ]);

        $updateData = [
            'judul' => 'Judul Baru Diperbarui',
            'kategori' => 'Akademik',
            'isi' => 'Isi baru yang sudah diperbaiki',
        ];

        $response = $this->actingAs($admin)->put(route('admin.informasi.update', $info), $updateData);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas('informasi', [
            'id' => $info->id,
            'judul' => 'Judul Baru Diperbarui',
        ]);
    }

    /**
     * Skenario 8: Admin menghapus informasi.
     */
    public function test_admin_can_delete_informasi(): void
    {
        $admin = User::factory()->admin()->create();

        $info = Informasi::create([
            'judul' => 'Akan Dihapus',
            'kategori' => 'Pengumuman',
            'isi' => 'Informasi ini akan segera dihapus',
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.informasi.destroy', $info));

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseMissing('informasi', ['id' => $info->id]);
    }

    /**
     * Skenario 9: Logout mengeluarkan pengguna dari sistem.
     */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    /**
     * Skenario 10: Seeder menyediakan data awal akun dan informasi contoh.
     */
    public function test_seeder_populates_initial_data(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', ['username' => 'admin', 'role' => 'admin']);
        $this->assertDatabaseHas('users', ['username' => 'siswa1', 'role' => 'user']);
        $this->assertDatabaseHas('users', ['username' => 'siswa2', 'role' => 'user']);
        $this->assertDatabaseHas('users', ['username' => 'siswa3', 'role' => 'user']);
        $this->assertGreaterThanOrEqual(5, Informasi::count());
    }
}
