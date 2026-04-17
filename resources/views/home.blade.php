@extends('layouts.public')
@section('content')

{{-- Navigation --}}
<nav class="nav" id="main-nav">
    <div class="container nav__inner">
        <a href="#" class="nav__logo">Obscura</a>
        <ul class="nav__links">
            <li><a href="#philosophy">Philosophy</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#reservation" class="text-accent">Reserve</a></li>
            <li><a href="{{ route('login') }}">Admin</a></li>
        </ul>
    </div>
</nav>

{{-- Hero --}}
<section class="hero" id="hero">
    <div class="hero__bg" role="img" aria-label="Fine dining atmosphere"></div>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow reveal">One table · One seating · One menu</p>
        <h1 class="hero__title reveal reveal--delay-1">Obscura</h1>
        <p class="hero__subtitle reveal reveal--delay-2">A singular evening of culinary artistry, crafted in darkness</p>
        <a href="#reservation" class="hero__cta reveal reveal--delay-3">Request a Table</a>
    </div>
</section>

{{-- Concept / Philosophy --}}
<section class="section" id="philosophy">
    <div class="container">
        <div class="philosophy">
            <div class="philosophy__text reveal">
                <p class="section__eyebrow">Our Philosophy</p>
                <h2 class="section__title">Beyond Dining</h2>
                <div class="divider" style="margin-left:0;"></div>
                <p>At Obscura, we believe that the most profound experiences emerge from constraint. One table. One seating each evening. A single ten-course journey conceived in its entirety — no substitutions, no choices, no distractions.</p>
                <p>Every element has been considered: the silence between courses, the weight of the cutlery, the temperature of the room. We do not serve food. We architect moments.</p>
                <p>Reservations are reviewed personally. Not every request is accepted. This is not exclusivity for its own sake — it is a commitment to the integrity of the experience.</p>
            </div>
            <div class="philosophy__image reveal reveal--delay-1">
                <img src="{{ asset('images/philosophy.jpg') }}" alt="Chef preparing a dish" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Menu --}}
<section class="section section--alt" id="menu">
    <div class="container container--narrow text-center">
        <p class="section__eyebrow reveal">The Journey</p>
        <h2 class="section__title reveal">Ten Courses</h2>
        <p class="section__desc reveal">A choreographed progression through texture, temperature, and memory. Each course exists in dialogue with the last.</p>
        <div class="divider reveal"></div>
    </div>
    <div class="container container--narrow">
        <div class="menu-grid">
            @php
                $courseLabels = [
                    1 => 'Amuse-Bouche',
                    2 => 'Cold Appetizer',
                    3 => 'Soup',
                    4 => 'Fish',
                    5 => 'Palate Cleanser',
                    6 => 'Main I',
                    7 => 'Main II',
                    8 => 'Cheese',
                    9 => 'Pre-Dessert',
                    10 => 'Grand Dessert',
                ];
            @endphp

            @foreach($menuItems->groupBy('course') as $courseNum => $items)
                <div class="menu-course reveal">
                    <h3 class="menu-course__title">
                        <span class="text-muted" style="font-size:0.75em; margin-right:0.5em;">{{ str_pad($courseNum, 2, '0', STR_PAD_LEFT) }}</span>
                        {{ $courseLabels[$courseNum] ?? 'Course ' . $courseNum }}
                    </h3>
                    @foreach($items as $item)
                        <div class="menu-item">
                            <div>
                                <h4 class="menu-item__name">{{ $item->title }}</h4>
                                <p class="menu-item__desc">{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Reservation Form --}}
<section class="section reservation-section" id="reservation">
    <div class="container container--narrow text-center">
        <p class="section__eyebrow reveal">By Request Only</p>
        <h2 class="section__title reveal">Reserve Your Evening</h2>
        <p class="section__desc reveal">Reservations are reviewed within 24 hours. You will receive a confirmation code and status update via email.</p>
        <div class="divider reveal"></div>
    </div>
    <div class="container">
        <form class="form reveal" method="POST" action="{{ route('reservation.store') }}" id="reservation-form">
            @csrf
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="first_name">First Name</label>
                    <input class="form__input" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="James" required>
                    @error('first_name') <span class="form__error">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <label class="form__label" for="last_name">Last Name</label>
                    <input class="form__input" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Whitmore" required>
                    @error('last_name') <span class="form__error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="email">Email</label>
                    <input class="form__input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
                    @error('email') <span class="form__error">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <label class="form__label" for="phone">Phone <span class="text-muted">(optional)</span></label>
                    <input class="form__input" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                    @error('phone') <span class="form__error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="date">Preferred Date</label>
                    <input class="form__input" type="date" id="date" name="date" value="{{ old('date') }}" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                    @error('date') <span class="form__error">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <label class="form__label" for="guests">Guests</label>
                    <select class="form__select" id="guests" name="guests" required>
                        <option value="" disabled {{ old('guests') ? '' : 'selected' }}>Select</option>
                        @for($i = 2; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>{{ $i }} Guests</option>
                        @endfor
                    </select>
                    @error('guests') <span class="form__error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="notes">Special Requests <span class="text-muted">(optional)</span></label>
                <textarea class="form__textarea" id="notes" name="notes" placeholder="Dietary restrictions, celebrations, or any notes for our team…">{{ old('notes') }}</textarea>
                @error('notes') <span class="form__error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="form__submit" id="submit-reservation">Submit Request</button>
        </form>
    </div>
</section>

{{-- Contact & Footer --}}
<section id="contact" class="section reveal">
    <div class="container text-center">
        <span class="section__eyebrow">Find Us</span>
        <h2 class="section__title">Kadıköy | İstanbul</h2>
        <p class="section__desc">
            Seating begins at 20:00 — one table, each evening<br>
            Tuesday — Saturday, 20:00 — 00:00
        </p>
        <p class="text-accent underline"><a href="mailto:hello@obscura.com">hello@obscura.com</a></p>
    </div>
</section>


<footer class="footer">
    <div class="container">
        <p class="footer__logo">Obscura</p>
        <p class="footer__copy">&copy; 2026 xviilab — Burak Yıldırım. A portfolio project — not a real restaurant.</p>
    </div>
</footer>

@endsection
