<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            'Air Conditioning',
            'Airport Transfer (on Demand)',
            'Banquet hall',
            'Bar',
            'Bonfire',
            'Business Services',
            'CCTV surveillance',
            'Caretaker',
            'Conference Room',
            'Contactless check-in',
            'Contactless room service',
            'Dining',
            'Disinfectant wipes',
            'Disinfection',
            'Dispensors for disinfectants',
            'Disposable serveware',
            'Doctor On Call',
            'Face shields',
            'First-aid Services',
            'Free Internet',
            'Gloves',
            'Hair nets',
            'Health-Spa',
            'Hospital in the vicinity',
            'Indoor Entertainment',
            'Internet',
            'Laundry Service',
            'Lounge',
            'Luggage assistance',
            'Luggage storage',
            'Masks',
            'Outdoor Activities',
            'Parking Facility',
            'Postal Services',
            'Power backup',
            'Restaurant/Coffee Shop',
            'Room Service',
            'Safety authorization certificate',
            'Sanitizers',
            'Sanitizers installed',
            'Shoe covers',
            'Smoking Rooms Available',
            'Spa',
            'Swimming Pool',
            'Travel Assistance',
            'Wheelchair'
        ];
        foreach ($amenities as $key => $amenity) {
            DB::table('amenities')->insert([
                'name' => $amenity,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}











