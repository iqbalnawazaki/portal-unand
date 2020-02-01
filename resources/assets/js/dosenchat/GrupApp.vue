<template>
  <div class="grup-app">
    <v-card>
      <v-list>
        <v-subheader>Chat Group</v-subheader>
        <v-divider></v-divider>
        <div class="feed" ref="feed">
          <v-list class="p-3" v-for="(message, index) in allMessages" :key="index">
            <v-flex>
              <span class="small">{{message.user.name}}</span>
            </v-flex>

            <div v-if="message.pesan" class="text-message-container">
              <v-chip
                :color="(user.id===message.user_id)?'#a2f488':'e3e8f8'"
                text-color="black"
              >{{message.pesan}}</v-chip>
            </div>

            <div v-if="message.image" class="image-container">
              <img :src="'/images/'+message.image" alt>
            </div>

            <v-flex>
              <span class="small">{{message.created_at}}</span>
            </v-flex>
          </v-list>
        </div>
      </v-list>
      <v-divider></v-divider>
      <v-card>
        <v-layout row wrap>
          <v-flex xs1>
            <v-dialog v-model="dialog" class="px-0 right" persistent max-width="500px">
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
                          @click="uploadImage"
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

          <v-flex xs8>
            <v-text-field
              single-line
              outline
              v-model="message"
              placeholder="Enter Message..."
              @keyup.enter="sendMessage"
            ></v-text-field>
          </v-flex>
        </v-layout>
      </v-card>
    </v-card>
  </div>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      message: null,
      myText: null,
      image: "",
      dialog: false,
      allMessages: [],
      token: document.head.querySelector('meta[name="csrf-token"]').content
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
      if (!this.image) {
        return;
      }

      axios.post("/messages", { image: this.image }).then(response => {
        this.image = null;
        this.allMessages.push(response.data.message);
        setTimeout(this.scrollToEnd, 100);
      });
    },
    sendMessage() {
      //check if there message
      if (!this.message) {
        return;
      }

      axios.post("/messages", { message: this.message }).then(response => {
        this.message = null;
        this.allMessages.push(response.data.message);
        setTimeout(this.scrollToEnd, 100);
      });
    },
    fetchMessages() {
      axios.get("/messages").then(response => {
        this.allMessages = response.data;
      });
    },
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    },

    scrollToEnd() {
      window.scrollTo(0, 99999);
    }
  },

  watch: {
    allMessages(allMessages) {
      this.scrollToBottom();
    }
  },

  mounted() {},

  created() {
    this.fetchMessages();

    Echo.private("grup").listen("MessageGrup", e => {
      this.allMessages.push(e.message);
      setTimeout(this.scrollToEnd, 100);
    });
  }
};
</script>

<style lang="scss" scoped>
.chat-app {
  display: flex;
}

.floating-div {
  position: fixed;
}
.grup-app img {
  max-width: 300px;
  max-height: 200px;
}
.feed {
  height: 100%;
  max-height: 470px;
  overflow: scroll;
}
</style>
