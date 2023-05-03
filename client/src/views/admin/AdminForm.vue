<template>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-form-admin/>
      </div>
      
    </div>
  </template>
  <script>
  import CardFormAdmin from "@/components/Cards/Forms/CardFormAdmin.vue";
  
  export default {
    components: {
        CardFormAdmin,
    },
  };
  </script>
  