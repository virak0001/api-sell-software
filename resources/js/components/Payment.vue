<template>
  <div ref="card" class="w-96 mx-auto bg-gray-100 rounded-lg p-5">
    <p class="text-center mb-5 text-3xl">Payment Method</p>
    <div class="card-number mb-3">
      <div id="card-number" ref="card-number"  />
      <div
        class="v-text-field__details mt-1 px-1"
      >
        <div class="v-messages theme--light error--text" role="alert">
          <div class="v-messages__wrapper">
            <div class="v-messages__message">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-expiry mb-3">
      <div id="card-expiry" ref="card-expiry" />
      <div
        class="v-text-field__details mt-1 px-2"
      >
        <div class="v-messages theme--light error--text" role="alert">
          <div class="v-messages__wrapper">
            <div class="v-messages__message">
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="-cvv mb-3">
      <div id="card-cvc" ref="card-cvv" />
      <div
        class="v-text-field__details mt-1 px-2"
      >
        <div class="v-messages theme--light error--text" role="alert">
          <div class="v-messages__wrapper">
            <div class="v-messages__message">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-between">
        <button @click="cancelModel" class="bg-red-500 hover:bg-red-700 float-right text-white font-bold py-2 px-4 border border-red-700 rounded">CANCEL</button>
        <button @click="createToken" class="bg-blue-500 hover:blue-red-700 float-right text-white font-bold py-2 px-4 border border-blue-700 rounded">ORDER</button>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
 data() {
  return {
  stripe:null,
  card: {
      cvc: '',
      number: '',
      expiry: ''
    },
    //elements
    cardNumber: '',
    cardExpiry: '',
    cardCvc: '',
    stripe: null,
    // errors
    stripeError: '',
    cardCvcError: '',
    cardExpiryError: '',
    cardNumberError: '',
    loading: false,
  }
 },
 mounted() {
  this.stripe = Stripe("pk_test_51JEuPkGt0yn4nN6sdUecEtJ1axXdupvtzQ1xiiTdlhItcp9SDH4oHtJFExxcLn89XqiGDv3p97QOKskwfKBR6gPy004lS0Oe9I")
  this.createAndMountFormElements()
 },
 methods: {
   
   cancelModel(){
     console.warn('GGG')
     this.$emit('cancel')
   },

  createAndMountFormElements() {
    var elements = this.stripe.elements();
    this.cardCvc = elements.create('cardCvc');
    this.cardExpiry = elements.create('cardExpiry');
    this.cardNumber = elements.create('cardNumber');
    this.cardCvc.mount('#card-cvc');
    this.cardExpiry.mount('#card-expiry');
    this.cardNumber.mount('#card-number');
  },
  toggleError(event) {
    if (event.error) {
        this.stripeError = event.error.message;
    } else {
      this.stripeError = '';
    }
  },

      onChangeCardNumber(event, type) {
        try {
          if (event.brand !== 'unknown') {
            this.card.number = 'cardNumber'
          } else {
            this.card.number = ''
          }
        } catch (e) {
          return e
        }
    },
    onChangeCardExpiry(event, type) {
        try {
          if (event.complete === true || type.elementType === 'cardExpiry') {
            this.card.expiry = 'cardExpiry'
          } else {
            this.card_expiry = ''
          }
        } catch (e) {
          return e
        }
    },
    onChangeCardCvv(event, type) {
        try {
          if (event.complete === true || type.elementType === 'cardCvv') {
            this.card.cvv = 'cardCvv'
          } else {
            this.card.cvv = ''
          }
        } catch (e) {
          return e
        }
      },
    onChangCardNumber(event) {
      this.onChangeCardNumber(event, 'card_number')
    },
    onChangCardExpiry(event) {
      this.onChangeCardExpiry(event, 'card_expiry')
    },
    onChangCardCvv(event) {
      this.onChangeCardCvv(event, 'card_cvv')
    },

  submitFormToCreateToken() {
    this.clearCardErrors();
    let valid = true;
    if (!this.card.number) {
      valid = false;
      this.cardNumberError = "Card Number is Required";
    }
    if (!this.card.cvc) {
      valid = false;
      this.cardCvcError = "CVC is Required";
    }
    if (!this.card.expiry) {
      valid = false;
      this.cardExpiryError = "Month is Required";
    }
    if (this.stripeError) {
      valid = false;
    }
    if (valid) {
      this.createToken()
    }
  },

  async createToken() {
   this.loading = true
   await this.stripe.createToken(this.cardNumber).then((result) => {
      this.loading = false
      if (result.error) {
        this.stripeError = result.error.message;
      } else {
        const token_id = result.token.id
        const res = axios.post('/api/orders', { token_id })
        console.warn(res)
      }
   })
},

reset() {
      this.clearElementInputs()
      this.clearCardErrors()
    },

    clearElementInputs() {
      this.cardCvc.clear()
      this.cardExpiry.clear()
      this.cardNumber.clear()
    },
clearCardErrors() {
      this.stripeError = ''
      this.cardCvcError = ''
      this.cardExpiryError = ''
      this.cardNumberError = ''
    },
 }
}
</script>

<style>
.StripeElement {
  border: 2px solid var(--v-secondary-base);
  border-radius: 6px;
  padding-left: 12px;
  padding-right: 12px;
  padding-top: 18px;
  padding-bottom: 18px;
  line-height: 1.375rem;
  transition: border 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
  font-family: 'Quicksand', sans-serif !important;
  border: 2px solid grey;
}

.StripeElement:hover {
  border: 2px solid grey;
}

.StripeElement--focus,
.StripeElement--focus:hover {
  border: 2px solid var(--v-primary-base);
}

.StripeElement--invalid,
.StripeElement--invalid:hover,
.StripeElement.StripeElement--error.StripeElement--empty,
.StripeElement--invalid.StripeElement.StripeElement--error,
.StripeElement--invalid.StripeElement.StripeElement--error:hover,
.StripeElement--invalid.StripeElement.StripeElement--error:focus {
  border: 2px solid var(--v-error-base);
}
.StripeElement--focus {
            border-color: #084280;
            outline:0;
            box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
</style>
