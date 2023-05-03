<template>
  <div>
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100">
      <form-navbar />
      <header-form />
      <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <router-view />
      </div>
    </div>
  </div>
</template>
<script>
import FormNavbar from "@/components/Navbars/FormNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderForm from "@/components/Headers/HeaderForm.vue";
export default {
  name: "admin-layout",
  components: {
    FormNavbar,
    Sidebar,
    HeaderForm,
  },
};
</script>
