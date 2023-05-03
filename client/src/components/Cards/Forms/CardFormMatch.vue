<template>
    <div
      class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
    >
      <div class="rounded-lg bg-white mb-0 px-6 py-6">
        <div class="text-center flex justify-between">
          <h6 class="text-blueGray-700 text-xl font-bold">Match</h6>
        </div>
      </div>
      <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
        <form>
          <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
            Informations sur le Match
          </h6>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="nom-match"
              >
                Nom du Match :
              </label>
              <input
                type="text"
                id="-nom-match"
                name="nom-match"
                placeholder="Nom du Match"
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              />
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="Date-match"
              >
                Date du Match :
              </label>
              <input
                type="date"
                id="date-match"
                name="date-match"
                placeholder="Date du Match"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              />
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="heure-match"
              >
                Heure du Match :
              </label>
              <input
                type="time"
                id="heure-match"
                name="heure-match"
                placeholder="Heure du match"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              />
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="type-match"
              >
                Type du Match :
              </label>
              <div class="flex justify-between">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    class="form-radio"
                    name="type-match"
                    value="national"
                    required
                  />
                  <span class="ml-2">National</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    class="form-radio"
                    name="type-match"
                    value="international"
                    required
                  />
                  <span class="ml-2">International</span>
                </label>
              </div>
            </div>
  
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="nom-equipe"
              >
                Nom de l'équipe 1 :
              </label>
              <select
                id="nom-equipe"
                name="nom-equipe"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
                v-model="selectedTeam"
              >
                <option value="">Choisissez une équipe</option>
                <option v-for="team in teams" :key="team.id" :value="team.nom">
                  {{ team.nom }}
                </option>
              </select>
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="nom-equipe"
              >
                Nom de l'équipe 2 :
              </label>
              <select
                id="nom-equipe"
                name="nom-equipe"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
                v-model="selectedTeam"
              >
                <option value="">Choisissez une équipe </option>
                <option v-for="team in teams" :key="team.id" :value="team.nom">
                  {{ team.nom }}
                </option>
              </select>
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="nom-stade"
              >
                Nom du Stade:
              </label>
              <select
                v-model="selectedStade"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              >
                <option value="">Choisissez un stade</option>
                <option v-for="stade in stades" :key="stade" :value="stade">
                  {{ stade }}
                </option>
              </select>
            </div>
          </div>
        </form>
        <div
          class="relative w-full px-4 max-w-full flex-grow flex-1 text-center"
        >
          <button
            class=" boutton-click active:bg-blueGray-600 font-bold   text-xss shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear "
            type="button"
            style="padding-right: 0.7rem; padding-left: 0.7rem"
           >
          confirmer
        </button>
       
        <button
          class=" boutton-annuler bg-blueGray-500 text-blueGray-400 active:bg-red-600 font-bold text-xss shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear "
          type="button"
          
          style="padding-right: 0.7rem; padding-left: 0.7rem"
        >
          annuler
        </button>
         </div>
    </div>
    </div>
  </template>
  <script>
  export default {
    data() {
      return {
        stades: [],
        selectedStade: "",
      };
    },
    mounted() {
      // Récupération de la liste des stades depuis la base de données
      fetch("http://localhost:3000/stades")
        .then((response) => response.json())
        .then((data) => {
          this.stades = data;
        });
    },
  };
  </script>