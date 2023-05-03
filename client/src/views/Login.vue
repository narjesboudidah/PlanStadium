<template>
  <div>
    <div class="relative pt-16 pb-32 min-h-screen-75">
      <div
        class="absolute top-0 w-full h-full bg-center bg-cover"
        style="
          background-image: url('https://images.unsplash.com/photo-1592340393531-6caf7789fc10?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=871&q=80');
        "
      >
      <span
          id="blackOverlay"
          class="w-full h-full absolute opacity-75 bg-black"
        ></span>
      </div>
      <div
        class="absolute top-0 w-full h-full flex justify-center items-center"
      >
        <div class="w-full lg:w-4/12 px-4">
          <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-tea-200"
          >
            <div class="flex-auto p-15 lg:p-10">
              <div class="rounded-t mb-0 px-6 py-6">
                <div class="text-center mb-3">
                  <img
                  alt="..."
                  :src="photo"
                  class="shadow-lg rounded-full mx-auto max-w-120-px"
                />
                  <h3 class="text-blueGray-200 text-xl font-bold">
                    Bienvenue sur <b style="color:#77a30b">PlanStadium</b> !
                  </h3>
                </div>

                <hr class="mt-6 border-b-1 border-blueGray-300" />
              </div>
              <div  class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form>
                  <div class="relative w-full mb-3">
                    <label  style="color:#6e8b27;"
                      class="block uppercase  text-xs font-bold mb-2"
                      htmlFor="grid-password"
                    >
                      Email
                    </label>
                    <input style="background-color:#c6d1a9;"
                      type="email" 
                      class="border-0 px-3 py-3 placeholder-kaki  bg-blueGray-700 rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      placeholder="Email"
                      v-model="form.email"
                    />
                  </div>

                  <div class="relative w-full mb-3">
                    <label style="color:#6e8b27;"
                      class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                      htmlFor="grid-password"
                    >
                      Password
                    </label>
                    <input  style="background-color:#c6d1a9;"
                      type="password"
                      class="border-0 px-3 py-3 placeholder-kaki bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      placeholder="Password"
                      v-model="form.password"
                    />
                  </div>
                  <div>
                    <div class="w-1/2">
                      <a href="javascript:void(0)" class="text-blueGray-500">
                        <small style="color:#a0a78e;">Forgot password?</small>
                      </a>
                    </div>
                  </div>

                  <div class="text-center mt-6">
                    <button 
                      class="text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                      type="button"
                      style="background-color: #77a30b;"
                      v-on:click="submit()"
                    >
                      Log In
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import photo from "@/assets/img/photo.png";
export default {
  data(){
    return{
      form: {
        email: "",
        password: ""
      },
      photo,
    };
  },
  methods: {
    submit: function() {
      console.log('email:', this.form.email);
      console.log('password:', this.form.password);
    }
  }
};
</script>

<style scoped>
.min-h-screen-75 {
  height: calc(100vh - 0rem);
  min-height: 24rem;
}
</style>