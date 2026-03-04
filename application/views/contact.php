<?php $this->view('top_header') ?> 

    <body>
       <?php $this->view('header') ?>

        <!-- Page Title -->
        <div class="page-title-area title-bg-eight">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="title-item">
                            <h2>Contact</h2>
                            <ul>
                                <li>
                                    <a href="<?php echo site_url("Welcome") ?>">Home</a>
                                </li>
                                <li>
                                    <span>Contact</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Contact Info -->
        <div class="contact-info-area pt-100 pb-70">
            <div class="container">
                <div class="row g-3">

                    

                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3 contact-info rounded-4 border-0 m-0" style="background-color:#f3f3f3; box-shadow:1px 1px 1px 1px #88888861; height:100%">
                            <i class="icofont-ui-call" style="padding-top: 40px;"></i>
                            <span>Phone:</span>
                            <a href="tel:+9191091 88876">+91-91091 88876</a>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3 contact-info rounded-4 border-0 m-0" style=" background-color:#f3f3f3;box-shadow:1px 1px 1px 1px #88888861; height:100%">
                            <i class="icofont-location-pin"></i>
                            <span>Location:</span>
                            <a href="#">Inside Garden City, Gram Indamara, NH-6 Near Aangan Resturant, Raj Nandgaon, India, Chhattisgarh</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3 contact-info rounded-4 border-0 m-0" style=" background-color:#f3f3f3; box-shadow:1px 1px 1px 1px #88888861; height:100%">
                            <i class="icofont-ui-email" style="padding-top: 40px;"></i>
                            <span>Email:</span>
                            <a href="mailto:aquavillagerjn@gmail.com">aquavillagerjn@gmail.com</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Contact Info -->

        <!-- Contact -->
        <div class="contact-area pb-70">
            <div class="container">

                <form id="contactForm">
                    <h2>Let's talk...!</h2>
                    <p>We’re here to help and answer any question you might have.We look forward to hearing from you.<br>
                     Above is our contact info. & Also feel free to fill out the form and we’ll be in touch as soon as possible.</p>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <i class="icofont-user-alt-3"></i>
                                </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <i class="icofont-ui-email"></i>
                                </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required data-error="Please enter your email">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <i class="icofont-ui-call"></i>
                                </label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Phone" required data-error="Please enter your number" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <i class="icofont-notepad"></i>
                                </label>
                                <input type="text" name="msg_subject" id="msg_subject" class="form-control" placeholder="Subject" required data-error="Please enter your subject">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <i class="icofont-comment"></i>
                                </label>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Write message" required data-error="Write your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="form-check agree-label">
                                    <input
                                        name="gridCheck"
                                        value="I agree to the terms and privacy policy."
                                        class="form-check-input"
                                        type="checkbox"
                                        id="gridCheck"
                                        required
                                    > -->
                                    <!-- <label class="form-check-label" for="gridCheck">
                                      Accept <a href="terms-condition.html">Terms & Conditions</a> And <a href="privacy-policy.html">Privacy Policy.</a>
                                    </label> -->
                                    <!-- <div class="help-block with-errors gridCheck-error"></div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn common-btn d-block m-auto w-100" style="width:400px">
                                Send Message
                            </button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </form>
    
            </div>
        </div>
        <!-- End Contact -->

        <!-- Map -->
        <div class="map-area">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.3371754156083!2d80.94836801436962!3d21.099119590749716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a295b422af65069%3A0x97942e81fff2d26!2sAqua%20Village%20Water%20Park%20And%20Resort!5e0!3m2!1sen!2sin!4v1676101118208!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- End Map -->

        <!-- Footer -->
        <?php $this->view('footer') ?>
        <!-- End Footer -->

  <?php $this->view('top_footer') ?>