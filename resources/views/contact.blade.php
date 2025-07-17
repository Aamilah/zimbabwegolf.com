<x-layout>
<section class="hero">
    <div class="hero-slice">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Want to make an enquiry?</h1>
                <p>We'd love to hear from you! Whether you have questions, feedback, or are looking to get involved with the Zimbabwe Golf Association, our team is ready to assist. Let's grow the future of golf together.</p>
            </div>
            <a href="{{route('about')}}">
                <div class="hero-button">
                    <button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button>
                </div>
            </a>
            <div class="hero-tags">
                <div class="hero-tag-row">
                    <div class="hero-tag-icon">
                        <img src="{{asset('icons/golf_ball_tee.png')}}" alt="golf ball tee icon">
                    </div>
                    <div class="hero-tag green-bg">
                        <p>Email us</p>
                    </div>
                    <div class="hero-tag gold-bg">
                        <p>Phone Us</p>
                    </div>
                </div>
                <div class="hero-tag-row">
                    <div class="hero-tag red-bg">
                        <p>Visit Us</p>
                    </div>
                    <div class="hero-tag black-bg">
                        <p>Zimbabwe Golf Association</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slice frame md:ml-10">
        <form action="#" method="POST" class="space-y-6 w-full max-w-md">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" required
                class="form-input" />
            </div>

      <!-- Email -->
      <div>
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" required
          class="form-input" />
      </div>

      <!-- Subject -->
      <div>
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" id="subject"
          class="form-input" />
      </div>

      <!-- Message -->
      <div>
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" rows="5" required
          class="form-input"></textarea>
      </div>

        <button class="red-gold-btn" type="submit">
            Send Message <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span>
        </button>
    </form>
    </div>
</section>
<section class="pre-footer">
    <div class="frame green-bg">
        <div class="text">
            <h2>Zimbabwe golf association</h2>
            <p>At the Zimbabwe Golf Association, our mission is to promote, develop, and grow the game at all levels, fostering excellence, integrity, and opportunity. Whether you're a player, supporter, or partner, your involvement drives our vision forward..</p>
        </div>
        <div class="box gold-bg">
            <h4>
                CONTACT US
            </h4>
            <p>Want to make an enquiry about an event? or sign up for a tournaments do not hesitate to contact us for more details</p>
            <button class="red-gold-btn"><a href="">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></a></button>
        </div>
    </div>
</section>

</x-layout>