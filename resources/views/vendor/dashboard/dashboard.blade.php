@extends('vendor.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')
      <div class="row mt-4">
        {{-- Eco Rating Message --}}
        <div class="alert alert-light" style="border-left: 5px solid #28a745; padding: 15px; margin: 15px; border-radius: 5px;">
          <h5 style="font-weight: bold;">🌱 Eco Rating – Give Electronics a Second Life</h5>
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