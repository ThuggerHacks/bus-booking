<?php
include 'inc/basic_template.php';
t_header("Agendamento de bilhetes");
t_navbar();
?>

<style>
  /* Add your styles for the About Us page */
  .about-us-section {
    background-color: #ebebeb;
    padding: 50px 0;
    text-align: center;
  }

  .team-section {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 30px;
  }

  .team-member {
    width:150px !important;
    height:150px !important;
    border-radius: 150px !important; width: 200px;
    margin: 15px;
  }

  .team-member img {
    width: 100%;
    border-radius: 50%;
    margin-bottom: 10px;
  }

  .mission-vision-section {
    background-color: #ebebeb;
    color: #111;
    padding: 50px 0;
    text-align: justify;
  }

  img:not(.team-member img) {
    max-width: 100% !important;
  }


</style>

<div class="about-us-section" style="margin-top:20px"> <br/><br/>
  <div class="container">
    <h2 class="mb-4">Sobre Nós</h2>
    <p>Bem-vindo ao nosso sistema de agendamento de bilhetes! Somos uma equipe dedicada a facilitar suas viagens curtas e longas, proporcionando uma experiência de reserva simples e eficiente. Estamos comprometidos em fornecer um serviço de alta qualidade, focado na comodidade e satisfação do cliente.</p>

    <div class="team-section">
      <!-- Team Members -->
      <div class="team-member">
        <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Team Member 1">
        <p>Sulehima</p>
        <p>CEO</p>
      </div>

      <div class="team-member">
        <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Team Member 2">
        <p>Sulehima</p>
        <p>CTO</p>
      </div>

      <div class="team-member">
        <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Team Member 3">
        <p>Sulehima</p>
        <p>COO</p>
      </div>

      <!-- Add more team members as needed -->
    </div>
  </div>
</div>

<div class="mission-vision-section">
  <div class="container">
    <!-- <h2 class="mb-4">Missão, Visão e Valores</h2> -->

    <div class="row">
      <div class="col-md-4">
        <h3>Missão</h3>
        <p>Nossa missão vai além de ser apenas uma plataforma de agendamento de bilhetes. Buscamos transformar a maneira como as pessoas vivenciam suas viagens, proporcionando uma jornada sem complicações e cheia de conforto. Comprometemo-nos a ser o elo confiável entre os viajantes e seus destinos, simplificando o processo de reserva e tornando cada viagem uma experiência memorável.</p>
      </div>

      <div class="col-md-4">
        <h3>Visão</h3>
        <p>Nossa visão é construir um mundo onde as viagens são mais do que meros deslocamentos; são oportunidades de explorar, aprender e criar memórias duradouras. Queremos ser reconhecidos como a principal escolha para quem procura uma plataforma de agendamento de bilhetes que não apenas atende, mas excede as expectativas. Com inovação contínua e um compromisso inabalável com a excelência, aspiramos a conectar pessoas e lugares de maneira mais significativa e eficiente.</p>
      </div>
      <hr/>
      <div class="col-md-4">
        <h3>Valores</h3>
        <p>Nossos valores são a espinha dorsal de nossa empresa, guiando cada decisão e ação. Valorizamos a transparência em todas as interações, pois acreditamos que a confiança é fundamental. Integridade é o alicerce sobre o qual construímos relacionamentos duradouros, tanto com nossos clientes quanto com nossos parceiros. Inovação é a chave para a evolução constante, e comprometemo-nos a buscar soluções criativas para melhorar continuamente nossos serviços. Comprometimento com a excelência é o que nos impulsiona a superar expectativas e a oferecer uma experiência excepcional em cada etapa do processo. Esses valores, combinados, nos permitem criar uma comunidade de viajantes satisfeitos e confiantes em nossos serviços.</p>
      </div>
    </div> <hr/>

    <div class="row" style="flex-wrap:wrap;;justify-content: space-between;">
    <h3 style="width:100%;">FOTOS DA EMPRESA</h3>
      <div class="col-md-4">
       <img src="https://trailways.com/wp-content/uploads/2019/08/Banner-Ticket-Information.jpg" alt="">
      </div>

      <div class="col-md-4">
      <img src="https://www.kkkl.com.sg/wp-content/uploads/2019/02/KKKL-BUS.jpg" alt="">
      </div>

      <div class="col-md-4">
      <img src="https://static.folhademaputo.co.mz/cImages/5_0000119000/img118962-135-20221221-165905.jpg" alt="">
      </div>
    </div>
  </div>
</div>

<?php
t_footer();
?>
