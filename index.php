<?php
include 'inc/basic_template.php';
t_header("Agendamento de Bilhetes");
t_navbar();
?>

<style>
  /* Add your styles for the Landing Page */
  .landing-slider {
    position: relative;
    overflow: hidden;
    height: 500px;
  }

  .slider-container {
    display: flex;
    transition: transform 0.5s ease-in-out;
  }

  .slider-content {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .slider-image {
    width: 100%;
    height: auto;
    object-fit: cover;
    filter:brightness(50%)
  }

  .slide-description {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #ffffff;
    max-width: 60%;
  }

  .faq-section,
  .partners-section,
  .info-cards-section {
    background-color: #f8f9fa;
    padding: 50px 0;
  }

  .faq-item {
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 8px;
  }

  .partners-logo {
    max-width: 100%;
    height: auto;
    filter: grayscale(100%);
    transition: filter 0.3s ease-in-out;
  }

  .partners-logo:hover {
    filter: grayscale(0%);
  }

  .info-card {
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
  }
</style>

<div class="landing-slider">
  <div class="slider-container">
    <!-- Slide 1 -->
    <div class="slider-content">
      <img class="slider-image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/YT23HYH_at_Tyndrum.jpg/800px-YT23HYH_at_Tyndrum.jpg" alt="Bus Image 4">
      <div class="slide-description">
        <h2>Viagens Confortáveis</h2>
        <p>Desfrute de viagens confortáveis em nossos modernos ônibus equipados com comodidades de última geração.</p>
      </div>
    </div>
  </div>
</div>

<div class="faq-section">
  <div class="container">
    <h2 class="mb-4">Perguntas Frequentes</h2>
    <div class="faq-item">
      <h3>Como posso fazer uma reserva?</h3>
      <p>Para fazer uma reserva, basta acessar nosso site, selecionar o destino desejado, escolher a data e número de passageiros, e seguir as instruções de pagamento.</p>
    </div>
    <div class="faq-item">
      <h3>É possível cancelar ou alterar uma reserva?</h3>
      <p>Sim, é possível cancelar ou alterar sua reserva antes da data de partida. Consulte nossa política de cancelamento para obter mais informações.</p>
    </div>
    <!-- Add more FAQ items as needed -->
  </div>
</div>

<div class="partners-section">
  <div class="container">
    <h2 class="mb-4">Nossos Parceiros</h2>
    <div class="d-flex justify-content-around">
      <span>NAGI</span>
      <span>CITY LINK</span>
      <span>VODACOM</span>
    </div>
  </div>
</div>

<div class="info-cards-section">
  <div class="container">
    <h2 class="mb-4">Informações Importantes</h2>
    <div class="row">
      <!-- Info Card 1 -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>Número de Ônibus Disponíveis</h3>
          <p>Atualmente, temos uma frota de <?php
          require_once 'inc/database.php';
          $conn = initDB();
          $res = $conn->query("select count(id) from buses ")->fetch_assoc();
          echo $res["count(id)"];
          ?> ônibus disponíveis para atender às suas necessidades de viagem.</p>
        </div>
      </div>
      <!-- Info Card 2 -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>Destinos Cobertos</h3>
          <p>Nossos ônibus viajam para uma variedade de destinos em todo o país, garantindo que você possa chegar onde precisa ir.</p>
        </div>
      </div>
      <!-- Info Card 3 -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>Atendimento ao Cliente</h3>
          <p>Nossa equipe de atendimento ao cliente está disponível 24 horas por dia, 7 dias por semana, para ajudar com suas dúvidas e preocupações.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
t_footer();
?>
