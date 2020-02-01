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
    messages: {
      type: Array,
      default: []
    }
  },
  data() {
    return {
      message: "",
      image: "",
      dialog: false,
      snackbar: false,
      color: "#f12d2d",
      y: "bottom",
      x: null,
      mode: "",
      timeout: 3000,
      text: "Pilih Kontak Bimbingan Akademik"
    };
  },
  methods: {
    sendMessage(pesan) {
      if (!this.contact) {
        this.snackbar = true;
        return;
      }

      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          pesan: pesan
        })
        .then(response => {
          this.$emit("new", response.data);
        });
    },
    uploadImage(image) {
      if (!this.contact) {
        return;
      }

      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          image: image
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
</style>
