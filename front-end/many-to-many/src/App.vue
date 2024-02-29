<template>
    <div>
      <h1>Tecnologie</h1>
      <ul>
        <li v-for="technology in technologies" :key="technology.id">{{ technology.name }}</li>
      </ul>
      <button @click="showCreateForm = !showCreateForm">Aggiungi tecnologia</button>
      <div v-if="showCreateForm">
        <input type="text" v-model="newTechnologyName" placeholder="Nome tecnologia">
        <button @click="createTechnology">Crea tecnologia</button>
      </div>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        technologies: [],
        showCreateForm: false,
        newTechnologyName: ''
      };
    },
    mounted() {
      this.getAllTechnologies();
    },
    methods: {
      getAllTechnologies() {
        axios.get('/api/technologies')
          .then(response => {
            this.technologies = response.data;
          })
          .catch(error => {
            console.error('Errore durante il recupero delle tecnologie:', error);
          });
      },
      createTechnology() {
        axios.post('/api/technologies', { name: this.newTechnologyName })
          .then(response => {
            this.technologies.push(response.data);
            this.newTechnologyName = '';
            this.showCreateForm = false;
          })
          .catch(error => {
            console.error('Errore durante la creazione della tecnologia:', error);
          });
      }
    }
  };
  </script>
