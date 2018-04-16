<!-- Ceci est un composant -->
<template>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-xl navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Menu burger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Menu Burger</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Menu -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="/" >Accueil</a>
                        </li>
                        <li class="">
                            <a href="/ideas">Boîte à idée</a>
                        </li>
                        <li class="">
                            <a href="/events">Evènements</a>
                        </li>
                        <li class="">
                            <a href="/shop">Boutique</a>
                        </li>
                    </ul>
                    <!-- Login -->
                    <ul class="nav navbar-nav navbar-right"> <!-- Position Left / Right-->
                        <li class="dropdown">
                            <a href="http://www.jquery2dotnet.com" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                <li>

                                        <div class="col-md-20">Connexion
                                            <form class="form" role="form" method="post" action="login" accept-charset="UTF-8"
                                                  id="login-nav">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Adresse Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail2"
                                                           placeholder="Adresse Email" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2">Mot de passe</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword2"
                                                           placeholder="Mot de passe" required="">
                                                    <div class="help-block text-right">
                                                        <a href="">Mot de passe oublié ?</a>
                                                    </div>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Rester connecté</label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bottom text-center">
                                            <a href="/register"><b>Pas encore inscrit ?</b></a>
                                        </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

