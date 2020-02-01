<template>
  <div class="conversation">
    <div>
      <v-chip
        color="#b2ebf2"
        class="badge badge-primary right"
        light
      >{{ contact ? contact.name : 'Pilih Kontak Chatting' }}</v-chip>
    </div>
    <v-divider></v-divider>
    <MessagesFeed :contact="contact" :messages="messages"/>
    <MessageComposer :contact="contact" @kirim="uploadImage" @send="sendMessage"/>

    <div class="card">
      <div class="card-header text-white bg-success mb-3">Topik Bimbingan Akademik</div>
      <div class="card-body">
        <select v-model="topikx" class="form-control">
          <option disabled value>
            <b>- - - Pilih Topik Bimbingan Akademik - - -</b>
          </option>
          <option
            v-for="topiks in topik"
            :key="topiks.id"
            v-bind:value="topiks.id"
          >{{ topiks.topik }}</option>
        </select>
        <br>
        <br>
      </div>
    </div>

    <v-snackbar
      v-model="snackbar"
      :color="color"
      :bottom="y === 'bottom'"
      :left="x === 'left'"
      :multi-line="mode === 'multi-line'"
      :right="x === 'right'"
      :timeout="timeout"
      :top="y === 'top'"
      :vertical="mode === 'vertical'"
    >
      {{ text }}
      <v-btn color="black" flat @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import MessagesFeed from "./MessagesFeed";
import MessageComposer from "./MessageComposer";

export default {
  props: {
    contact: {
      type: Object,
      default: null
    },
    topik: {
      type: Array,
      default: null
    },
    messages: {
      type: Array,
      default: []
    }
  },
  data() {
    return {
      message: "",
      topikx: "",
      image: "",
      dialog: false,
      snackbar: false,
      color: "#f12d2d",
      y: "bottom",
      x: null,
      mode: "",
      timeout: 3000,
      text: "Pilih Kontak dan Topik Bimbingan Akademik"
    };
  },
  methods: {
    sendMessage(pesan) {
      if (!this.contact) {
        this.snackbar = true;
        return;
      } else if (!this.topikx) {
        this.snackbar = true;
        return;
      }

      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          pesan: pesan,
          topik: this.topikx
        })
        .then(response => {
          this.$emit("new", response.data);
        });
    },
    uploadImage(image) {
      if (!this.contact) {
        this.snackbar = true;
        return;
      } else if (!this.topikx) {
        this.snackbar = true;
        return;
      }

      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          image: image,
          topik: this.topikx
        })
        .then(response => {
          this.$emit("new", response.data);
        });
    }
  },
  components: { MessagesFeed, MessageComposer }
};
</script>

<style lang="scss" scoped>
.conversation {
  flex: 5;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  h1 {
    font-size: 20px;
    padding: 10px;
    margin: 0;
    border-bottom: 1px dashed lightgray;
  }
}
.topik {
  border: 5px;
  color: black;
}
</style>
