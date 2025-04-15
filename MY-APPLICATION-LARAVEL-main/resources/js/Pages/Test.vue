<template>
    <div class="container">
      <h1>Gestion des Produits Dolibarr</h1>

      <!-- Récupérer tous les produits -->
      <div>
        <button @click="fetchProducts">Récupérer tous les produits</button>
        <div v-if="products.length">
          <ul>
            <li v-for="product in products" :key="product.id">
              {{ product.name }} - {{ product.price }}€
              <button @click="fetchProductById(product.id)">Détails</button>
              <button @click="deleteProduct(product.id)">Supprimer</button>
            </li>
          </ul>
        </div>
      </div>

      <!-- Détails du produit -->
      <div v-if="productDetail">
        <h2>Détails du produit</h2>
        <p>Nom: {{ productDetail.name }}</p>
        <p>Prix: {{ productDetail.price }}€</p>
        <p>Note: {{ productDetail.array_options.options_etoile }}</p>

        <div>
          <h3>Mettre à jour la note</h3>
          <input type="number" v-model.number="newNote" min="0" max="5" />
          <button @click="updateNote">Mettre à jour la note</button>
        </div>
      </div>

      <!-- Ajouter un produit -->
      <div>
        <h2>Ajouter un produit</h2>
        <input type="text" v-model="newProduct.name" placeholder="Nom du produit" />
        <input type="number" v-model.number="newProduct.price" placeholder="Prix du produit" />
        <button @click="addProduct">Ajouter</button>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        products: [], // Liste des produits
        productDetail: null, // Détails d'un produit spécifique
        newProduct: { name: '', price: '' }, // Nouveau produit
        newNote: null, // Nouvelle note pour un produit
      };
    },
    methods: {
      // Récupérer tous les produits
      async fetchProducts() {
        try {
          const response = await fetch('/api/dolibarr/products');
          if (response.ok) {
            this.products = await response.json();
          } else {
            alert('Erreur lors de la récupération des produits');
          }
        } catch (error) {
          console.error('Erreur:', error);
          alert('Erreur lors de la récupération des produits');
        }
      },

      // Récupérer un produit par ID
      async fetchProductById(id) {
        try {
          const response = await fetch(`/api/dolibarr/products/${id}`);
          if (response.ok) {
            this.productDetail = await response.json();
          } else {
            alert('Produit non trouvé');
          }
        } catch (error) {
          console.error('Erreur:', error);
          alert('Erreur lors de la récupération du produit');
        }
      },

      // Mettre à jour la note d'un produit
      async updateNote() {
        if (this.newNote < 0 || this.newNote > 5) {
          alert('La note doit être entre 0 et 5');
          return;
        }

        const productId = this.productDetail.id;
        const response = await fetch('/api/dolibarr/products/update-note', {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            product_id: productId,
            new_note: this.newNote,
          }),
        });

        if (response.ok) {
          alert('Note mise à jour');
          this.fetchProductById(productId); // Rafraîchir les détails du produit
        } else {
          alert('Erreur lors de la mise à jour de la note');
        }
      },

      // Ajouter un produit
      async addProduct() {
        const response = await fetch('/api/dolibarr/products', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            name: this.newProduct.name,
            price: this.newProduct.price,
          }),
        });

        if (response.ok) {
          const newProduct = await response.json();
          this.products.push(newProduct); // Ajouter le produit à la liste
          this.newProduct = { name: '', price: '' }; // Réinitialiser le formulaire
          alert('Produit ajouté');
        } else {
          alert('Erreur lors de l\'ajout du produit');
        }
      },

      // Supprimer un produit
      async deleteProduct(id) {
        const response = await fetch(`/api/dolibarr/products/${id}`, {
          method: 'DELETE',
        });

        if (response.ok) {
          this.products = this.products.filter((product) => product.id !== id);
          alert('Produit supprimé');
        } else {
          alert('Erreur lors de la suppression du produit');
        }
      },
    },
  };
  </script>

  <style scoped>
  .container {
    margin: 20px;
  }

  input[type="text"], input[type="number"] {
    margin: 10px;
  }

  button {
    margin: 5px;
  }
  </style>
