<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100"
  >
    <div class="rounded-lg bg-white mb-0 px-6 py-6">
      <div class="text-center flex justify-between">
        <h6 class="text-blueGray-700 text-xl font-bold">Admin</h6>
      </div>
    </div>
    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
      <form>
        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
          Informations sur l'admin
        </h6>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4 mb-3">
            <label
              class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              for="nom-admin"
            >
              Nom de l'admin :
            </label>
            <input
              type="text"
              id="nom-admin"
              name="nom-admin"
              placeholder="Nom de l'admin"
              required
              class="border-2 border-blueGray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
            />
          </div>
          <div class="w-full lg:w-6/12 px-4 mb-3">
            <label
              class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              for="prenom-admin"
            >
              Prénom de l'admin :
            </label>
            <input
              type="text"
              id="prenom-admin"
              name="prenom-admin"
              placeholder="Prénom de l'admin"
              required
              class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
            />
          </div>
          <div class="w-full lg:w-6/12 px-4 mb-3">
            <label
              class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              for="telephone"
            >
              Téléphone :
            </label>
            <input
              type="tel"
              id="telephone"
              name="telephone"
              placeholder="Téléphone"
              required
              pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
              class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
            />
          </div>
          <div class="w-full lg:w-6/12 px-4 mb-3">
            <label
              class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              for="email"
            >
              Email :
            </label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Email"
              required
              class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
            />
          </div>

          <div class="w-full lg:w-6/12 px-4 mb-3">
            <label
              class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              for="adresse"
            >
              Adresse :
            </label>
            <input
              type="text"
              id="adresse"
              name="adresse"
              placeholder="Adresse"
              required
              class="border-2 border-blueGray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-3 rounded-md text-sm shadow"
            />
          </div>
        </div>
        <hr class="mt-6 border-b-1 border-blueGray-300" />

        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
          Role de l'admin
        </h6>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4 mb-3">
            <fieldset>
              <legend
                class="block uppercase tracking-wide text-blueGray-600 text-xs font-bold mb-2"
              >
                Role :
              </legend>
              <div class="mt-2" style="display: flex">
                <div class="mr-4">
                  <input
                    type="radio"
                    id="admin-maintenance"
                    name="role"
                    value="1"
                    checked
                  />
                  <label for="admin-maintenance"> Admin équipe</label>
                </div>
                <div class="mr-4">
                  <input
                    type="radio"
                    id="admin-maintenance"
                    name="role"
                    value="2"
                  />
                  <label for="admin-maintenance"> Admin ste maintenance</label>
                </div>
                <div class="mr-4">
                  <input
                    type="radio"
                    id="admin-federation"
                    name="role"
                    value="3"
                  />
                  <label for="admin-federation"> Admin fédération</label>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
        <hr class="mt-6 border-b-1 border-blueGray-300" />

        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
          Permission de l'admin
        </h6>
        <div>
        <div>Checked names: {{ checkedNames }}</div>
        <div class="mt-2 space-y-2" style="display: flex">
          <div class="flex items-center ml-3 mr-1">
            <input
              type="checkbox"
              id="jack"
              value="Jack"
              v-model="checkedNames"
            />
            <label for="jack">Jack</label>
          </div>

          <div class="flex items-center ml-3 mr-1">
            <input
              type="checkbox"
              id="john"
              value="John"
              v-model="checkedNames"
            />
            <label class="ml-3 mr-1" for="john">John</label>
          </div>

          <div class="flex items-center ml-3 mr-1">
            <input
              type="checkbox"
              id="mike"
              value="Mike"
              v-model="checkedNames"
            />
            <label for="mike">Mike</label>
          </div>
        </div>
        </div>
      </form>
      <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-center">
        <button
          class="boutton-click active:bg-blueGray-600 font-bold text-xss shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear"
          type="button"
          style="padding-right: 0.7rem; padding-left: 0.7rem"
        >
          confirmer
        </button>

        <button
          class="boutton-annuler bg-blueGray-500 text-blueGray-400 active:bg-red-600 font-bold text-xss shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear"
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
      checkedNames: [],
    };
  },
};
</script>
