<template>
  <div class="feed" ref="feed">
    <ul v-if="contact">
      <li
        v-for="message in messages"
        :class="`message${message.penerima_id == contact.id ? ' received' : ' sent'}`"
        :key="message.id"
      >
        <div
          v-if="message.pesan"
          :color="(message.penerima_id == contact.id)?'#b2b2b2':'#a2f488'"
          class="text"
        >{{message.pesan}}</div>

        <div v-if="message.image" class="image-container">
          <img :src="'/images/'+message.image" alt>
        </div>

        <div class="waktu">
          {{ message.created_at }}
          <b>{{ message.topik }}</b>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      type: Object
    },
    messages: {
      type: Array,
      required: true
    }
  },
  methods: {
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    }
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages) {
      this.scrollToBottom();
    }
  }
};
</script>

<style lang="scss" scoped>
.image-container img {
  max-width: 300px;
  max-height: 200px;
}
.feed {
  background: #ffffff;
  height: 100%;
  max-height: 470px;
  overflow: scroll;

  ul {
    list-style-type: none;
    padding: 5px;

    li {
      &.message {
        margin: 10px 0;
        width: 100%;

        .text {
          max-width: 320px;
          border-radius: 5px;
          padding: 5px;
          font-size: 12px;
          display: inline-block;
          color: #022802;
        }
        .waktu {
          font-size: 10px;
        }
        .img {
          max-width: 300px;
          max-height: 200px;
        }

        &.received {
          text-align: right;

          .text {
            background: #a2f488;
          }
        }

        &.sent {
          text-align: left;

          .text {
            background: #b2b2b2;
          }
        }
      }
    }
  }
}
</style>
