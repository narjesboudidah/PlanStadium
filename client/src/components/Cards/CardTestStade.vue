<template>
    <div>
      <main class="profile-page">
        <section class="relative block h-500-px">
          <div
            class="absolute top-0 w-full h-full bg-center bg-cover"
            style="
              background-image: url('https://images.pexels.com/photos/46792/the-ball-stadion-football-the-pitch-46792.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            "
          >
            <span
              id="blackOverlay"
              class="w-full h-full absolute opacity-50 bg-black"
            ></span>
          </div>
          <div
            class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
            style="transform: translateZ(0)"
          >
            <svg
              class="absolute bottom-0 overflow-hidden"
              xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="none"
              version="1.1"
              viewBox="0 0 2560 100"
              x="0"
              y="0"
            >
              <polygon
                class="text-blueGray-200 fill-current"
                points="2560 0 2560 100 0 100"
              ></polygon>
            </svg>
          </div>
        </section>
        <section class="relative py-17 bg-blueGray-200" >
          <div class="container mx-auto px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64"
            >
              
                
                <div class="flex flex-wrap justify-center">
                  <div class="items-center flex flex-wrap">
                    <div class=" object-cover">
                      <img
                        alt="..."
                        class="rounded-lg shadow-xl"
                        src="https://images.pexels.com/photos/3571569/pexels-photo-3571569.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                      />
                    </div>
                    <div
                      style="margin:2rem; margin-left:10rem;"
                      class="w-full md:w-5/12 ml-auto mr-auto px-4"
                    >
                      <div class="md:pr-12">
                        <h3 class="text-3xl font-semibold">Olympique de Radès</h3>
                        <p class="mt-4 text-lg leading-relaxed text-blueGray-700">
                          Le stade olympique de Radès (arabe : الملعب الأولمبي
                          برادس) ou stade olympique Hammadi-Agrebi de Radès (arabe
                          : الملعب الأولمبي حمادي العقربي برادس) est un stade
                          situé à Radès, dans la banlieue sud-est de Tunis
                          (Tunisie), au cœur d'un complexe sportif situé à une
                          dizaine de kilomètres du centre-ville de la capitale
                          tunisienne.
                        </p>
                        <ul class="list-none mt-6">
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  person
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700">
                                  Directeur Général : Mouhamed Hamed
                                </h4>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  call
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700 text-l">
                                  Phone : +216 77 777 777
                                </h4>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  pin_drop
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700">Pays : Tunisie</h4>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  groups
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700">Capacite : 5000</h4>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  stadium
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700 text-l">
                                  Surface : 200
                                </h4>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="flex items-center">
                              <div>
                                <span
                                  class="material-symbols-outlined icon-sidebar-click1"
                                >
                                  sports_soccer
                                </span>
                              </div>
                              <div>
                                <h4 class="text-blueGray-700">Matchs : 50</h4>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </section>
      </main>
    </div>
  </template>
  <script>
  import team2 from "@/assets/img/stadium.jpg";
  
  export default {
    data() {
      return {
        team2,
      };
    },
    components: {},
  };
  </script>
  