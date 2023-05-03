<template>
    <div>
      <div class="flex flex-wrap">
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-ajout-match />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
          <card-match />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
            <card-match />
        </div>
        <div class="w-full xl:w-4/12 mb-12 xl:mb-0 px-4">
            <card-match />
        </div>
      </div>
      
    </div>
  </template>
  <script>
  
  import CardMatch from "@/components/Cards/CardMatch.vue";
  import CardAjoutMatch from "@/components/Cards/Ajouter/CardAjoutMatch.vue";
  export default {
    name: "dashboard-page",
    components: {
      CardMatch,
      CardAjoutMatch,
    },
  };
  </script>
  