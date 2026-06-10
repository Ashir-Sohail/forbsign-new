<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(['type' => 'about_us'], [
            'title' => 'About Us',
            'description' => 'This is the About Us page.',
            'meta_title' => 'About Us - Company Info',
            'meta_description' => 'Learn about our company, team, and mission.',
            'meta_keywords' => 'about us, company, team, mission',
            'meta_url' => 'about-us',
        ]);

        Page::updateOrCreate(['type' => 'terms_condition'], [
            'title' => 'Terms & Conditions',
            'description' => 'These are the terms and conditions.',
            'meta_title' => 'Terms & Conditions - Our Policies',
            'meta_description' => 'Read our website terms, usage policy, and conditions.',
            'meta_keywords' => 'terms, conditions, policy',
            'meta_url' => 'terms-and-conditions',
        ]);

        Page::updateOrCreate(['type' => 'delivery_info'], [
            'title' => 'Delivery Information',
            'description' => 'Details about how and when we deliver products.',
            'meta_title' => 'Delivery Info - Shipping & Time',
            'meta_description' => 'Understand our delivery policies and timelines.',
            'meta_keywords' => 'delivery, shipping, shipping time, delivery info',
            'meta_url' => 'delivery-information',
        ]);
    }
}
