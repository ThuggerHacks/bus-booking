<?php
include 'inc/basic_template.php';
t_header("Agendamento de bilhetes");
t_navbar();
?>

<style>
  /* Add your styles for the Contact Us page */
  .contact-us-section {
    background-color: #ffffff;
    padding: 50px 0;
  }

  .company-info {
    text-align: center;
    margin-bottom: 30px;
  }

  .google-map {
    height: 400px;
    margin-bottom: 30px;
  }

  .contact-details {
    text-align: center;
    margin-bottom: 30px;
  }
</style>

<div class="contact-us-section" >
  <div class="container" style="margin-top:100px">
    <h2 class="mb-4">Entre em Contato</h2>

    <div class="company-info">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Bus.svg/2560px-Bus.svg.png" alt="Logo da Empresa" style="width: 150px; height: 150px; border-radius: 150px;">
      <h3>TRANSPORTER</h3>
      <p>Rua Alfredo Lawley - Matacuane, Beira</p>
    </div>

    <div class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1131.218827409442!2d34.86403761439547!3d-19.832421803557096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1f2a4027d25b54c1%3A0x332692b555cb6034!2sUniversidade%20Zambeze%20-%20UniZambeze!5e1!3m2!1spt-PT!2smz!4v1699554524683!5m2!1spt-PT!2smz" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="contact-details">
      <h3>Informações de Contato</h3>
      <p>Email: info@transporter.com</p>
      <p>Telefone: +258 84 563 0579</p>
      <p>Gerente Geral: Sulehima Abdula</p>
    </div>
  </div>
</div>

<?php
t_footer();
?>
