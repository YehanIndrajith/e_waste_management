@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard" style="background-color: #e6f3e6; min-height: 100vh; padding: 20px;">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')
        
        {{-- Profile Completion Alert --}}
        <div class="alert alert-warning" style="background-color: #fff3cd; border-left: 5px solid #ffc107; margin: 15px 0; padding: 15px; border-radius: 5px;">
            <h5 style="font-weight: bold; color: #856404;">
                🚨 Profile Completion Reminder
            </h5>
            <p style="color: #856404;">
                Complete your Vendor Shop Profile Before Adding Products
                <a href="{{ route('vendor.shop-profile.index') }}" class="btn btn-warning btn-sm ml-3">
                    Complete Profile Now
                </a>
            </p>
        </div>

        <div class="row mt-4">
            {{-- Eco Rating Message --}}
            <div class="alert alert-light" style="background-color: #f0f8f0; border-left: 5px solid #28a745; padding: 15px; margin: 15px; border-radius: 5px;">
                <h5 style="font-weight: bold; color: #28a745;">🌱 Eco Rating – Give Electronics a Second Life</h5>
                <ul style="list-style-type: none; padding: 0;">
                    <li style="color: #28a745; font-weight: bold;">
                        ✅ <strong>Green Badge</strong> – Good condition, long-lasting, and perfect for reuse. A smart, eco-friendly choice.
                    </li>
                    <li style="color: #ffc107; font-weight: bold;">
                        ⚠️ <strong>Yellow Badge</strong> – Decent condition, needs some love & repairs, but still usable.
                    </li>
                    <li style="color: #dc3545; font-weight: bold;">
                        ❌ <strong>Red Badge</strong> – Bad condition, short lifespan, limited reuse.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection