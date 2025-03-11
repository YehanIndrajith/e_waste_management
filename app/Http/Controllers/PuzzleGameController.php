<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PuzzleGameController extends Controller
{
    public function showBeginnerPuzzle()
    {
        $words = [
            'BATTERY' => 'Powers portable devices; needs recycling due to toxic chemicals.',
            'CHARGER' => 'Transfers electricity to recharge devices.',
            'RECYCLE' => 'Proper processing of e-waste to reuse materials.',
            'PHONE' => 'Essential communication device, often part of e-waste.',
            'LAPTOP' => 'Foldable device with a screen and keyboard for work and entertainment.'
        ];
        $shuffledWords = $this->shuffleWords(array_keys($words));
        return view('frontend.activities.beginner.puzzle', compact('words', 'shuffledWords'));
    }

    public function showIntermediatePuzzle()
    {
        $words = [
            'MONITOR' => 'Screen for viewing computer content.',
            'MERCURY' => 'Hazardous material in screens and bulbs; requires careful recycling.',
            'CRT' => 'Bulky, glass-tube technology in older TVs and monitors.',
            'DONATION' => 'Giving functional devices to those in need.',
            'CIRCUIT' => 'Interconnected pathways for electronic components.'
        ];
        $shuffledWords = $this->shuffleWords(array_keys($words));
        return view('frontend.activities.intermediate.puzzle', compact('words', 'shuffledWords'));
    }

    public function showProPuzzle()
    {
        $words = [
            'SUSTAINABILITY' => 'Responsible resource use for long-term environmental health.',
            'LANDFILL' => 'Site for buried waste, often causing pollution.',
            'INCINERATION' => 'Burning waste, harmful when involving e-waste.',
            'DISMANTLING' => 'Breaking devices into parts for recycling or reuse.',
            'DOWNCYCLING' => 'Recycling where materials are reused in a less valuable form.'
        ];
        $shuffledWords = $this->shuffleWords(array_keys($words));
        return view('frontend.activities.pro.puzzle', compact('words', 'shuffledWords'));
    }

    private function shuffleWords(array $words)
    {
        shuffle($words);
        return $words;
    }
}
