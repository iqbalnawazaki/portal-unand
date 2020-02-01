<template>
  <div class="composer">
    <v-container grid-list-md text-xs-center>
      <v-layout row wrap>
        <v-flex xs1>
          <v-dialog class="px-0 right" v-model="dialog" persistent max-width="500px">
            <v-btn fab dark small color="teal" slot="activator">
              <v-icon dark>image</v-icon>
            </v-btn>
            <v-card>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn fab small dark color="black" flat @click="dialog = false">
                  <v-icon dark>close</v-icon>
                </v-btn>
              </v-card-actions>

              <div class="card card-default">
                <div class="card-body">
                  <div class>
                    <div class="col-md-3" v-if="image">
                      <img :src="image" class="img-responsive" height="70" width="90">
                    </div>
                    <br>
                    <div class="col-md-8">
                      <input type="file" v-on:change="onImageChange" class="form-control">
                    </div>
                    <br>
                    <div class="col-md-3">
                      <button
                        class="btn btn-success btn-block"
                        @click="kirim"
                        v-on:click="dialog = false"
                      >Kirim Gambar</button>
                    </div>
                  </div>
                </div>
              </div>
              <br>
            </v-card>
          </v-dialog>
        </v-flex>

        <v-flex xs10>
          <textarea
            outline
            v-model="message"
            @keydown.enter="send"
            placeholder="Enter Message..."
            autofocus
          ></textarea>
        </v-flex>
        <br>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      message: "",
      image: "",
      dialog: false
    };
  },
  methods: {
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    uploadImage() {
      if (!this.contact) {
        return;
      }

      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          image: this.image
        })
        .then(response => {
          this.$emit("new", response.data);
        });
    },
    send(e) {
      e.preventDefault();

      if (this.message == "") {
        return;
      } else {
      }

      this.$emit("send", this.message);
      this.message = "";
    },
    kirim(k) {
      k.preventDefault();

      if (this.image == "") {
        return;
      } else {
      }

      this.$emit("kirim", this.image);
      this.image = "";
    }
  }
};
</script>

<style lang="scss" scoped>
.composer textarea {
  width: 96%;
  margin: 2px;
  resize: none;
  border-radius: 5px;
  border: 2px solid rgb(100, 96, 96);
  padding: 5px;
}
</style>
