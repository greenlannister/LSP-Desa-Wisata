   <!-- Contact -->
   <div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">CONTACT</div>
                    <h2>Get In Touch With Us</h2>
                    <p>Visit our information center or use the contact form below for any questions about your Danau Toba adventure</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Danau Toba Tourism Center, Samosir Island, North Sumatra, Indonesia</li>
                        <li><i class="fas fa-phone"></i><a href="tel:+62651234567">+62 8953-3920-8923</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:+62651234568">+62 8954-1108-5522</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:info@laketobatourism.com">putriauliarahma129@gmail.com</a></li>
                    </ul>
                    <h3>Follow Danau Toba Tourism</h3>

                    <span class="fa-stack">
                        <a href="https://www.tiktok.com/@lev.low?is_from_webapp=1&sender_device=pc">
                            <span class="hexagon"></span>
                            <i class="fab fa-tiktok fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="https://www.instagram.com/greennieee_?igsh=MXFlMjJjbjl5bHRzZg==">
                            <span class="hexagon"></span>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="https://x.com/strllesht?t=RDy1XfZE94cCmDKIQyhWOQ&s=09">
                            <span class="hexagon"></span>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="https://www.linkedin.com/in/putriauliarahma?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                            <span class="hexagon"></span>
                            <i class="fab fa-linkedin fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="https://github.com/greenlannister">
                            <span class="hexagon"></span>
                            <i class="fab fa-github fa-stack-1x"></i>
                        </a>
                    </span>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                
                <!-- Contact Form -->
                <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" data-toggle="validator" data-focus="false">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control-input" id="cname" name="cname" required>
                        <label class="label-control" for="cname">Name</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control-input" id="cemail" name="cemail" required>
                        <label class="label-control" for="cemail">Email</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control-textarea" id="cumessage" name="cumessage" required></textarea>
                        <label class="label-control" for="cumessage">Your message</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">SUBMIT MESSAGE</button>
                    </div>
                    <div class="form-message">
                        <div id="cmsgSubmit" class="h3 text-center hidden"></div>
                    </div>
                </form>
                <!-- end of contact form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-2 -->
<!-- end of contact -->
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        const userMessageDiv = document.getElementById('cmsgSubmit');
        
        submitButton.disabled = true;
        submitButton.textContent = 'MENGIRIM...';
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.reset();
                userMessageDiv.textContent = data.message;
                userMessageDiv.classList.remove('hidden');
                userMessageDiv.style.color = 'green';
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            userMessageDiv.textContent = error.message || 'Terjadi kesalahan saat mengirim.';
            userMessageDiv.classList.remove('hidden');
            userMessageDiv.style.color = 'red';
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.textContent = 'SUBMIT MESSAGE';
        });
    });
</script>
