<!-- Le fichier constitue le composant principal, englobant tous les autres composants de l'application et dans lequel
il faut importer tous les composants nécessaires !-->

<script>
    import Header from './components/Header';
    import Footer from './components/Footer';

    export default {
        name: 'app',
        components: {
            'appHeader' : Header,
            'appFooter' : Footer
        }
    };
</script>


<template>
  <div id="app">
    <appHeader></appHeader>
      <!-- Image + Texte décallage -->
      <div class="col-md-12 main">
          <h1 data-aos="fade-right" data-aos-duration="1800" data-aos-once="true">BDE CESI</h1>
          <p data-aos="fade-left" data-aos-duration="1800" data-aos-once="true">Bienvenue sur notre site officiel</p>
          <p><img src="/Images/Logo_BDE.png" alt=""></p>
      </div>

      <appFooter></appFooter>
  </div>
</template>
