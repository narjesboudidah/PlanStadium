<template>
  <nav
    style="border-radius: 1rem"
    class="md:left-0 md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
  >
    <div
      class="bg-BlueGray-100 md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto1"
    >
      <!-- Toggler -->
      <button
        class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
        type="button"
        v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Brand -->
      <router-link
        class="md:block text-left md:pb-2  mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-1"
        to="/"
      >
      <span 
          class="w-13 h-13 text-sm bg-white inline-flex items-center justify-center rounded-full px-01"
        >
      <img
            alt="..."
            style="margin-right: 3px;"
            :src="image"
          />
         <p style="margin-left: 3px; font-size: 16px; color:#47b839;">PlanStadium</p>
      </span>
      </router-link>
      <!-- User -->
      <ul class="md:hidden items-center flex flex-wrap list-none">
        <li class="inline-block relative">
          <notification-dropdown />
        </li>
        <li class="inline-block relative">
          <user-dropdown />
        </li>
      </ul>
      <!-- Collapse -->
      <div
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative lmm md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
        v-bind:class="collapseShow"
      >
        <!-- Collapse header -->

        <!-- Form -->
        <form class="mt-6 mb-4 md:hidden">
          <div class="mb-3 pt-0">
            <input
              type="text"
              placeholder="Search"
              class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
            />
          </div>
        </form>

        <!-- Divider -->
        <hr style="margin-top: 0.3rem;" class="my-4 md:min-w-full" />
        <!-- Heading -->
        <!-- Navigation -->
        <!--ACCUIEL-->
        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <li class="items-center" >
            <router-link
              to="/admin/dashboard"
              v-slot="{ href, navigate, isActive }"
            >
              <a 
                style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive 
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span  
                class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]" > home </span>
                 Accuiel
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link
              to="/admin/users"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                  ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span 
                 class="material-symbols-outlined"
                 @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]" > group_add </span>
                Gestion des admins
              </a>
            </router-link>
          </li>

          <!--Planning-->

          <li class="items-center">
            <router-link
              to="/admin/planning"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span 
                 class="material-symbols-outlined"
                 @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> calendar_month </span>
                Planning
              </a>
            </router-link>
          </li>

          <!--LISTE DES DEMANDES-->
          <li class="items-center">
            <router-link
              to="/admin/listeDemande"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]">
                  free_cancellation
                </span>
                Liste des demandes
              </a>
            </router-link> 
          </li>
          <li class="items-center">
            <router-link
              to="/admin/competition"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> lan </span>
                Competitions
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link
              to="/admin/events"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> event_available </span>
                Evenements
              </a>
            </router-link>
          </li>
          <!--Equipe-->
          <li class="items-center">
            <router-link
              to="/admin/equipe"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> diversity_2 </span>
                Equipes
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/ste" v-slot="{ href, navigate, isActive }">
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> engineering </span>
                Stes de maintenance
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link
              to="/admin/stades"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                  @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> stadium </span>
                Stades
              </a>
            </router-link>
          </li>

        <!-- Navigation -->
          <li class="items-center">
            <router-link
              to="/profile"
              v-slot="{ href, navigate, isActive }"
            >
              <a
              style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
              <span class="material-symbols-outlined"
              @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> account_circle </span>
              Profile</a>
            </router-link>
          </li>

          <!-- <li class="items-center">
            <router-link
               style="font-family: inherit,serif;font-size: 15px;"
              class="text-blueGray-700 hover:text-blueGray-300 py-3 block"
              to="/auth/login"
            >
              <span class="material-symbols-outlined"
              @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> logout </span>
              Logout
            </router-link>
          </li> -->

          <li class="items-center">
            <router-link
              to="/admin/settings"
              v-slot="{ href, navigate, isActive }"
            >
              <a
                 style="font-family: inherit,serif;font-size: 15px;"
                :href="href"
                @click="navigate"
                class="text-xs py-3 block"
                :class="[
                  isActive
                    ? 'box-sidebar hover:text-red-600 '
                    : 'text-blueGray-700 hover:text-blueGray-500',
                ]"
              >
                <span class="material-symbols-outlined"
                @click="navigate"
                :class="[
                  isActive 
                    ? 'icon-sidebar-click '
                    : 'icon-sidebar',
                ]"> settings </span>
                Paramètres
              </a>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
); }

<script>
import NotificationDropdown from "@/components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";

import image from "@/assets/img/photo.png";

export default {
  data() {
    return {
      collapseShow: "hidden",
      image,
    };
  },
  methods: {
    toggleCollapseShow: function (classes) {
      this.collapseShow = classes;
    },
  },
  components: {
    NotificationDropdown,
    UserDropdown,
   
  },
};
</script>
