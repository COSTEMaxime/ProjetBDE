<!-- Le fichier constitue le composant principal, englobant tous les autres composants de l'application et dans lequel
il faut importer tous les composants nécessaires !-->

<script>
    import Header from '../components/Header';
    import Footer from '../components/Footer';

    export default {
        name: 'register',
        components: {
            'appHeader' : Header,
            'appFooter' : Footer
        }
    };

</script>


<template>
  <div id="register">
    <appHeader></appHeader>
      <!-- Image + Texte décallage -->
      <div class="col-md-12 main">
          <p><img src="/Images/Logo_BDE.png" alt=""></p>
      </div>
      <appFooter></appFooter>
  </div>
</template>


