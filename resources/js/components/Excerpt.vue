<template>
    <div class="media post">

        <div class="d-flex flex-column counters">
            <div class="vote">
                <strong>{{votes_count}}</strong>{{ plural_vote }}
            </div>
            <div :class="classes">
                <strong>{{answers_count}}</strong>{{ plural_answer }}
            </div>
            <div class="view">
               {{ plural_views }}
            </div>
        </div>
        <div class="media-body">

            <div class="d-flex align-items-center">
                <h3 class="mt-0">
                    <a :href="url">
                        {{ title }}
                    </a>

                </h3>


        </div>
        <p class="lead">

            Asked by
            <a :href="user.url">{{user.name}}</a>
            <small class="text-muted">{{created_date}}</small>
        </p>






        </div>
    </div>

</template>

<script>
      export default {


        props:['question'],


        data() {

        return {
            id : this.question.id,
            title : this.question.title,
            votes_count : this.question.votes_count,
            status : this.question.status,
            answers_count : this.question.answers_count,
            views : this.question.views,
            plural_vote : this.question.plural_vote,
            plural_answer : this.question.plural_answer,
            plural_views : this.question.plural_views,
            url : this.question.url,
            user: this.question.user,
            created_date : this.question.created_date,

        }

        },

          computed:{
              classes(){
                  return [
                      "status",
                      this.status
                  ]
              },


          }
    }


</script>