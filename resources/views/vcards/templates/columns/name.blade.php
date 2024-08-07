@php

$TEMPLATE_NAME = [
       1 => 'Simple Contact',
       2 => 'Executive Profile',
       3 => 'Clean Canvas',
       4 => 'Professional',
       5 => 'Corporate Connect',
       6 => 'Modern Edge',
       7 => 'Business Beacon',
       8 => 'Corporate Classic',
       9 => 'Corporate Identity',
       10 => 'Pro Network',
       11 => 'Portfolio',
       12 => 'Gym',
       13 => 'Hospital',
       14 => 'Event Management',
       15 => 'Salon',
       16 => 'Lawyer',
       17 => 'Programmer',
       18 => 'CEO/CXO',
       19 => 'Fashion Beauty',
       20 => 'Culinary Food Services',
       21 => 'Social Media',
       22 => 'Dynamic vcard',
       23 => 'Consulting Services',
       24 => 'School Templates',
       25 => 'Social Services',
       26 => 'Retail E-commerce',
       27 => 'Pet Shop',
       28 => 'Pet Clinic',
       29 => 'Marriage',
       30 => 'Taxi Service',
       31 => 'Handyman Services',
   ];
   @endphp
<div class="d-flex align-items-center">
    <a href="/{{ $row->name }}" target="_blank">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->template_url}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="/{{ $row->name }}" target="_blank" class="mb-1 text-decoration-none fs-6">
            {{$TEMPLATE_NAME[$row->id]}}
        </a>
    </div>
</div>
