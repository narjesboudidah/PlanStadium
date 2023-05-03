<template>
    <div
      class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
    >
      <div class="rounded-lg bg-white mb-0 px-6 py-6">
        <div class="text-center flex justify-between">
          <h6 class="text-blueGray-700 text-xl font-bold">compétition</h6>
        </div>
      </div>
      <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
        <form>
          <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
            Informations sur la compétition
          </h6>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="nom-competition"
              >
                Nom du compétition :
              </label>
              <input
                type="text"
                id="nom-competition"
                name="nom-competition"
                placeholder="Nom du compétition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              />
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="annee-competition"
              >
                Année du compétition :
              </label>
              <input
                type="number"
                id="annee-competition"
                name="annee-competition"
                placeholder="Année du compétition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
                min="1900"
                max="9999"
              />
            </div>
  
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                for="date-debut-competition"
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              >
                Date début de compétition :
              </label>
              <input
                type="date"
                id="date-debut-competition"
                name="date-debut-competition"
                placeholder="Date début de compétition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
                aria-describedby="date-debut-competition-helper"
                min="{{ new Date().toISOString().slice(0, 10) }}"
              />
            </div>
  
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                for="date-fin-competition"
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              >
                Date fin de compétition :
              </label>
              <input
                type="date"
                id="date-fin-competition"
                name="date-fin-competition"
                placeholder="Date fin de compétition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
                aria-describedby="date-fin-competition-helper"
                min="{{ new Date().toISOString().slice(0, 10) }}"
                onchange="validateDate()"
              />
            </div>
  
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="type-competition"
              >
                Type de compétition :
              </label>
              <select
                id="type-competition"
                name="type-competition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              >
                <option value="" disabled selected>
                  Sélectionnez le type de compétition
                </option>
                <option value="1">Championnat national</option>
                <option value="2">Coupe nationale</option>
                <option value="3">Supercoupe nationale</option>
                <option value="4">Ligue des champions</option>
                <option value="5">Ligue Europa</option>
                <option value="6">Supercoupe de l'UEFA</option>
                <option value="7">Coupe du monde</option>
                <option value="8">Coupe des confédérations</option>
                <option value="9">Championnat d'Europe</option>
                <option value="10">Coupe d'Europe des nations</option>
              </select>
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="categorie-competition"
              >
                Catégorie de compétition :
              </label>
              <select
                id="categorie-competition"
                name="categorie-competition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              >
                <option value="" disabled selected hidden>
                  Choisissez une catégorie
                </option>
                <option value="amateur">Amateur</option>
                <option value="professionnel">Professionnel</option>
                <option value="jeunes">Jeunes</option>
              </select>
            </div>
  
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="organisateur-competition"
              >
                Organisateur du compétition :
              </label>
              <input
                type="text"
                id="organisateur-competition"
                name="organisateur-competition"
                placeholder="Organisateur du compétition"
                required
                min="1"
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              />
            </div>
            <div class="w-full lg:w-6/12 px-4 mb-3">
              <label
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
                for="description-competition"
              >
                Description du compétition :
              </label>
              <textarea
                id="description-competition"
                name="description-competition"
                placeholder="Description du compétition"
                required
                class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
              ></textarea>
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
  // eslint-disable-next-line no-unused-vars
  function validateDate() {
    const startDateInput = document.querySelector("#date-debut-competition");
    const endDateInput = document.querySelector("#date-fin-competition");
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
  
    if (endDate < startDate) {
      endDateInput.setCustomValidity(
        "La date de fin doit être supérieure à la date de début."
      );
    } else {
      endDateInput.setCustomValidity("");
    }
  }
  </script>