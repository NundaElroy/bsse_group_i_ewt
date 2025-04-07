<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $animals = [
            [
                'name' => 'Lion',
                'description' => 'The king of the jungle, our lions enjoy a large savanna habitat.',
                'imageUrl' => 'https://via.placeholder.com/300x200?text=Lion'
            ],
            [
                'name' => 'Elephant',
                'description' => 'Our gentle giants from Africa, loved by visitors of all ages.',
                'imageUrl' => 'https://via.placeholder.com/300x200?text=Elephant'
            ],
            [
                'name' => 'Penguin',
                'description' => 'Playful aquatic birds that entertain visitors with their antics.',
                'imageUrl' => 'https://via.placeholder.com/300x200?text=Penguin'
            ],
            [
                'name' => 'Gorilla',
                'description' => 'Intelligent primates that are part of our conservation program.',
                'imageUrl' => 'https://via.placeholder.com/300x200?text=Gorilla'
            ]
        ];

        return view('home', compact('animals'));
    }
}