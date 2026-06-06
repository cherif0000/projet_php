<section id="contact" class="contact section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <div><span>Besoin d'aide ?</span> <span class="description-title">Contactez-nous</span></div>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="row gy-4">
              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Adresse</h3>
                  <p>Almadies, Dakar, Sénégal</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Téléphone</h3>
                  <p>+221 77 000 00 00</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p>contact@dakarstay.sn</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <form action="contactController" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Votre nom" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Votre email" required>
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Sujet" required>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Votre message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading">Envoi en cours...</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Votre message a bien été envoyé. Merci !</div>
                  <button type="submit">Envoyer</button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>

    </section>