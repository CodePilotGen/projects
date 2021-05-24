<template>
    <!-- <h1>{{mydetails()}}</h1> -->
    <div class="container">

      <div class="result-box" v-if="actionIndex/* || stage !== 'welcome'*/">
        <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th>Hypothesis</th>
              <th>Level</th>
              <th>Confidence</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hypothesis-result" v-for="(hypothesisItem, i) in hypothesis" :key="i">
              <td>{{hypothesisItem.title}}</td>
              <td>{{hypothesisItem.level}}</td>
              <td>{{hypothesisItem.confidence}}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <transition name="fade" mode="out-in" v-if="!loading">
        <div :key="curQuizInd">
          <h1 class="quiz-heading" v-html="title"></h1>
          <div class="start-box" v-if="stage === 'welcome'">
            <button type="button" class="btn btn-primary" @click="nextQuiz">start</button>
          </div>
          <div class="option-box" v-if="stage === 'quiz'">
            <ul class="quiz-options">
              <p class="quiz-option" v-for="(option, i) in questions[curQuizInd].options" :key="i">
                
                <input class="form-check-input quiz-question-button" :checked="option.check" type="checkbox" @click="clickOption(i)">
                <label class="form-check-label">
                  {{option.title}}
                </label>

              </p>
            </ul>
            <button type="button" class="btn btn-primary" :disabled="curQuizInd===0" @click="prevQuiz">Prev</button>
            <button type="button" class="btn btn-primary" @click="nextQuiz">Next</button>
          </div>
        
        </div>
      </transition>
    </div>
</template>

<script>
let questionData = require('../data/questions.json')
let hypothesisData = require('../data/hypothesis.json')

export default {
  name: 'Main',
  data () {
    return {
      loading: true,
      msg: 'Welcome to Your Vue.js App',
      questions: questionData,
      // currentQuestion: questionData.length > 0 ? questionData[0] : null,
      curQuizInd: -1,
      topQuizInd: -1,
      hypothesis: {},
      stage: 'welcome',
      title: 'Welcome to Consulting System. <br> Will you try?',
      actionIndex: 0
    }
  },
  computed: {
  },
  methods: {
    async init () {
      for (var i in hypothesisData) {
        this.hypothesis[hypothesisData[i].id] = {'title': hypothesisData[i].title, 'totalPoint': 0, 'point': 0, 'confPoint': 0, 'level': 0, 'curConfPoint': 0 , 'confidence': 0}
      }
      for (var j in questionData) {
        var optionList = questionData[j].options
        for (var k in optionList) {
          this.questions[j].options[k].check = false
          var hypothesisList = optionList[k].hypothesis
          for (var l in hypothesisList) {
            this.hypothesis[hypothesisList[l].id].totalPoint += hypothesisList[l].point
            if (questionData[j].visible) {
              this.hypothesis[hypothesisList[l].id].confPoint += hypothesisList[l].point
            }
          }
        }
      }
      this.loading = false
      // console.log(this.questions, this.hypothesis)
    },
    calculateLevel () {
      var numeral = require('numeral')
      for (var i in this.hypothesis) {
        i = String(i)
        this.hypothesis[i].level = numeral(this.hypothesis[i].point / this.hypothesis[i].confPoint).format('0.00')
        // this.hypothesis[i].confidence = Math.round(this.hypothesis[i].confPoint / this.hypothesis[i].totalPoint * 100)
      }
    },
    reCalculateConfidence () {

    },
    nextQuiz () {
      while (1) {
        // this.calculateLevel()
        this.curQuizInd++
        if (this.curQuizInd < this.questions.length) {
          // if visible === false, continue to the next quiz
          if (!this.questions[this.curQuizInd].visible) continue
          // else, display this quiz
          this.title = this.questions[this.curQuizInd].title
          // this.stage = 'quiz'
        } else {
          // Recalculate result level, confidence value
          this.title = 'Result'
          // this.stage = 'result'
        }
        // calculate confidence
        if (this.curQuizInd > this.topQuizInd + 1) {
          this.topQuizInd = this.curQuizInd - 1
          var optionList =  this.questions[this.topQuizInd].options
          for (var k in optionList) {
            var hypothesisList = optionList[k].hypothesis
            for (var l in hypothesisList) {
              this.hypothesis[hypothesisList[l].id].curConfPoint += hypothesisList[l].point
              this.hypothesis[hypothesisList[l].id].confidence = Math.round( this.hypothesis[hypothesisList[l].id].curConfPoint /  this.hypothesis[hypothesisList[l].id].totalPoint * 100)
            }
          }
        }
        this.actionIndex++
        break
      }
      this.loading = false
    },
    prevQuiz () {
      if (this.curQuizInd > 0) {
        this.title = this.questions[this.curQuizInd - 1].title
        // this.stage = 'quiz'
      } else {
        this.title = 'Welcome to Consulting System'
        // this.stage = 'welcome'
      }
      this.curQuizInd--
      this.actionIndex++
      this.loading = false
    },
    clickOption (index) {
      // console.log(index)
      this.questions[this.curQuizInd].options[index].check = !this.questions[this.curQuizInd].options[index].check
      var curChkState = this.questions[this.curQuizInd].options[index].check
      var hypothesisList = this.questions[this.curQuizInd].options[index].hypothesis
      for (var i in hypothesisList) {
        var dif = curChkState ? hypothesisList[i].point : -1 * hypothesisList[i].point
        this.hypothesis[hypothesisList[i].id].point += dif
      }
      // console.log(this.curQuizInd, index)
      this.calculateLevel()
      // this.stage = "quiz"
      this.actionIndex++
    }
  },
  watch: {
    curQuizInd (val) {
      if (val !== null) {
        if (val < this.questions.length) {
          this.stage = 'quiz'
        }
        else this.stage = 'result'
      }
    }
  },
  async mounted () {
    await this.init()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .hypothesis-result span {
    margin: 0 20px;
  }

  .option-box{
    display: inline-block;
  }
 
  .loader {
    height: 32px;
    width: 32px;
  }
  .loader span {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    margin: auto;
    height: 32px;
    width: 32px;
  }
  .loader span::before,
  .loader span::after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    margin: auto;
    height: 32px;
    width: 32px;
    border: 2px solid #fff;
    border-radius: 50%;
    opacity: 0;
    animation: loader-1 1.5s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;
  }

  .quiz-option{
    text-align: left;
  }
  @keyframes loader-1 {
    0% {
      transform: translate3d(0, 0, 0) scale(0);
      opacity: 1;
    }
    100% {
      transform: translate3d(0, 0, 0) scale(1.5);
      opacity: 0;
    }
  }
  .loader span::after {
    animation: loader-2 1.5s cubic-bezier(0.075, 0.82, 0.165, 1) 0.25s infinite;
  }
  @keyframes loader-2 {
    0% {
      transform: translate3d(0, 0, 0) scale(0);
      opacity: 1;
    }
    100% {
      transform: translate3d(0, 0, 0) scale(1);
      opacity: 0;
    }
  }
  /* Transition */
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s, transform 0.5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: scale(0.95);
  }

  .result-box{
    margin-bottom: 25px;
  }
  .result-box table {
    margin: auto;
  }
</style>
