<template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-row-reverse align-items-center">
                        <div id="header-logo"></div>
                        <div id="header-guild-name">
                            <p id="header-guild-text">THE FALLEN</p>
                            <p id="header-guild-subtext">EU-Ysondre</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-sm navbar-custom">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <router-link :to="{ name: 'home' }">Home</router-link>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <router-link :to="{ name: 'roster' }">Roster</router-link>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <router-link :to="{ name: 'forum' }">Forum</router-link>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Vidéos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">TF Tools</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Warcraftlogs</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="container-fluid">
                <div class="wrapper-content mt-4">
                    <div class="row pt-0">
                        <div class="col-md-3 col-sm-5">
                            <aside>
                                <RecruitingBlock />
                            </aside>
                            <aside>
                                <RaiderioBlock />
                            </aside>
                        </div>

                        <article class="main-content-block col-sm-7 col-md-9 mt-2">
                            <transition name="fade">
                                <router-view></router-view>
                            </transition>
                        </article>

                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    import { RecruitingBlock } from './partials/RecruitingBlock.vue';

    export default {
        data() {
            return {
                isLoading: false
            }
        }
    }
</script>
