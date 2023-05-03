import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";

// styles

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";

// mouting point for the whole app

import App from "@/App.vue";

// layouts

import Admin from "@/layouts/Admin.vue";
import Forms from "@/layouts/Forms.vue";

// views for Admin layout

import Dashboard from "@/views/admin/Dashboard.vue";
import Settings from "@/views/admin/Settings.vue";
import Tables from "@/views/admin/Tables.vue";
import Maps from "@/views/admin/Maps.vue";
import GestionAdmins from "@/views/admin/GestionAdmins.vue";
import ListeDemande from "@/views/admin/ListeDemande.vue";
import Competition from "@/views/admin/Competition.vue";
import Matchs from "@/views/admin/Matchs.vue";
import Stades from "@/views/admin/Stades.vue";
import Stade from "@/views/admin/Stade.vue";
import Equipe from "@/views/admin/Equipe.vue";
import AdminForm from "@/views/admin/AdminForm.vue";
import CompetitionForm from "@/views/admin/CompetitionForm.vue";
import EquipeForm from "@/views/admin/EquipeForm.vue";
import SteForm from "@/views/admin/SteForm.vue";
import StadeForm from "@/views/admin/StadeForm.vue";
import MatchForm from "@/views/admin/MatchForm.vue";
import SocieteMaintenance from "@/views/admin/SocieteMaintenance.vue";
// views for Auth layout

import Login from "@/views/Login.vue";
// views without layouts

import Profile from "@/views/Profile.vue";

// routes
const routes = [
  {
    path: "/admin",
    redirect: "/admin/dashboard",
    component: Admin,
    children: [
      {
        path: "/admin/dashboard",
        component: Dashboard,
      },
      {
        path: "/admin/settings",
        component: Settings,
      },
      {
        path: "/admin/tables",
        component: Tables,
      },
      {
        path: "/admin/competition",
        component: Competition,
      },
      
       {
        path: "/admin/competition/match",
        component:Matchs,
      },
      {
        path: "/admin/listeDemande",
        component: ListeDemande,
      },
      {
        path: "/admin/users",
        component: GestionAdmins,
      },
      
      {
        path: "/admin/maps",
        component: Maps,
      },
      {
        path: "/admin/stades",
        component: Stades,
      },
      {
        path: "/admin/stades/stade",
        component: Stade,
      },
      {
        path: "/admin/equipe",
        component:Equipe,
      },
      {
        path: "/admin/ste",
        component: SocieteMaintenance,
      },
    ],
  },
  {path: "/form",
    redirect: "/admin/dashboard",
    component: Forms,
    children: [
      {
        path: "/form/AjoutAdmin",
        component: AdminForm,
      },
      {
        path: "/form/AjoutCompetition",
        component: CompetitionForm,
      },
      {
        path: "/form/AjoutEquipe",
        component: EquipeForm
      },
      {
        path: "/form/AjoutSte",
        component: SteForm
      },
      {
        path: "/form/AjoutStade",
        component: StadeForm
      },
      {
        path: "/form/AjoutMatch",
        component: MatchForm
      },

    
    ]
    },
 
  {
    path: "/logout",
    component: Login,
  },
  {
    path: "/profile",
    component: Profile,
  },
  {
    path: "/",
    component: Login,
  },
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(router).mount("#app");
