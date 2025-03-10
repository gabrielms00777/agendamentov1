<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\{
    User,
    Service,
    Professional,
    Appointment,
    Payment,
    Product,
    Sale,
    LoyaltyPoint
};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => 'admin',
            'role' => UserRoleEnum::ADMIN->value,
        ]);

        $receptionist = User::create([
            'name' => 'Recepcionista',
            'email' => 'receptionist@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::RECEPTIONIST->value,
        ]);

        $professional = User::create([
            'name' => 'Profissional',
            'email' => 'professional@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::PROFESSIONAL->value,
        ]);

        $client = User::create([
            'name' => 'Cliente',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::CLIENT->value,
        ]);

        // Criar serviços
        $haircut = Service::create([
            'name' => 'Corte de Cabelo',
            'description' => 'Corte de cabelo moderno.',
            'duration' => 30,
            'price' => 50.00,
        ]);

        $manicure = Service::create([
            'name' => 'Manicure',
            'description' => 'Manicure completa.',
            'duration' => 60,
            'price' => 80.00,
        ]);

        // Criar profissional
        $professionalUser = Professional::create([
            'user_id' => $professional->id,
            'photo_url' => 'https://example.com/professional.jpg',
        ]);

        // Associar serviços ao profissional
        $professionalUser->services()->attach([$haircut->id, $manicure->id]);

        // Criar agendamento
        $appointment = Appointment::create([
            'client_id' => $client->id,
            'professional_id' => $professionalUser->id,
            'service_id' => $haircut->id,
            'date_time' => now()->addDays(1),
            'status' => 'pending',
        ]);

        // Criar pagamento
        Payment::create([
            'appointment_id' => $appointment->id,
            'amount' => 50.00,
            'status' => 'pending',
        ]);

        // Criar produtos
        $shampoo = Product::create([
            'name' => 'Shampoo',
            'description' => 'Shampoo profissional.',
            'price' => 25.00,
        ]);

        $conditioner = Product::create([
            'name' => 'Condicionador',
            'description' => 'Condicionador profissional.',
            'price' => 30.00,
        ]);

        // Criar venda
        Sale::create([
            'client_id' => $client->id,
            'product_id' => $shampoo->id,
            'quantity' => 2,
            'total_price' => 50.00,
            'date' => now(),
        ]);

        // Criar pontos de fidelidade
        LoyaltyPoint::create([
            'user_id' => $client->id,
            'points' => 100,
        ]);
    }
}
