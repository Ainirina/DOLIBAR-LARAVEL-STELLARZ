<template>
    <div class="media-wrapper">
      <figure class="media-container">
        <img v-if="type === 'image'" :src="source" :alt="alt" class="media-content" />
        <video v-else-if="type === 'video'" controls class="media-content">
          <source :src="source" type="video/mp4">
          Your browser does not support videos.
        </video>
        <figcaption class="media-caption">{{ caption }}</figcaption>
      </figure>
    </div>
  </template>

  <script>
  export default {
    props: {
      type: {
        type: String,
        required: true,
        validator: value => ['image', 'video'].includes(value)
      },
      source: {
        type: String,
        required: true
      },
      alt: {
        type: String,
        default: ''
      },
      caption: {
        type: String,
        default: ''
      }
    }
  }
  </script>

  <style scoped>
  .media-wrapper {
    background-color: #0D0D0D;
    padding: 20px 0;
    display: flex;
    justify-content: center;
  }

  .media-container {
    width: 100%;
    max-width: 1000px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .media-content {
    width: 100%;
    height: auto;
    max-height: 600px;
    object-fit: contain;
    border-radius: 12px;
  }

  .media-caption {
    margin-top: 10px;
    color: #ccc;
    font-size: 14px;
    text-align: center;
    font-style: italic;
  }

  video.media-content {
    background-color: #000;
  }
  </style>
