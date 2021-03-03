<template>
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="/">Back</a>
        </div>
        <div class="book-review" v-for="(book) in book" :key="book.id">
            <div class="row">
                <div class="col-5">
                    <img class="book-review-image" :src="book.cover" alt="book cover image">
                </div>
                <div class="col">
                    <div v-if="user_id != null">
                        <a :href="'/book/'+book.slug+'/report'" class="book-report-link" style="color: black"><i class="far fa-paper-plane mr-3" style="text-decoration: underline; font-size: 17px"> Report book</i></a>
                    </div>
                    <div class="single-book-title">
                        <h2>{{book.title}}</h2>
                    </div>
                    <hr>
                    <ul>
                        <li><h5 class="genre-name">{{ book.authors }}</h5></li>
                        <li class="book-average-rating mr-3">
                            <strong>Rating: </strong>
                                <div v-for="(rating, index) in Math.floor(book.rating)" :key="index" style="display: inline">
                                    <i v-if="getStars(index)" class="fas fa-star rating-star-color"></i>
                               </div>
                        </li>
                    </ul>
                    <ul>
                        <li><h5><span class="badge badge-pill badge-secondary genre-name">{{ book.genres }}</span></h5></li>
                    </ul>
                    <div class="single-book-description">
                        {{book.description}}
                    </div>
                </div>
            </div>

        <div class="row mt-5">
            <div class="col">
                <h3>Reviews</h3>
            </div>
            <div class="col">
                <div v-if="user_id != null">
                    <div class="row justify-content-end mr-1">
                        <button class="btn btn-dark btn-sm" @click='showCommentForm()'>Leave a comment about this book</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success" style="text-align: center" v-if='successMessage'>
            Thanks for your review! 
       </div>

        <div class="comment-form" id="commentForm" v-show='!hiddenCommentForm'>
            <button type="button" class="close mb-2 mt-2" aria-label="Close" @click='hideCommentForm()'>
                <span aria-hidden="true">&times;</span>
            </button>
            <hr>

        <form @submit.prevent="addReview(book.id)">
            <div class="rate-this-book">
                <strong>Rate this book!</strong>
            </div>
            <div class="stars">
                <input class="star star-5" id="star-5" type="radio" name="stars" v-model="review.stars" value="5" />
                <label class="star star-5" for="star-5"></label>
                 
                <input class="star star-4" id="star-4" type="radio" name="stars" v-model="review.stars" value="4" />
                <label class="star star-4" for="star-4"></label> 
                
                <input class="star star-3" id="star-3" type="radio" name="stars" v-model="review.stars" value="3" />
                <label class="star star-3" for="star-3"></label>  
                
                <input class="star star-2" id="star-2" type="radio" name="stars" v-model="review.stars" value="2" />
                <label class="star star-2" for="star-2"></label> 
                
                <input class="star star-1" id="star-1" type="radio" name="stars" v-model="review.stars" value="1" /> 
                <label class="star star-1" for="star-1"></label>
            </div>
            
            <br>

            <div class="form-group">
                <textarea name="comment" v-model="review.comment" class="form-control" rows="5" placeholder="Leave your comment about this book here.."></textarea>
            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success custom-submit-button">Share comment</button>
            </div>
        </form>
        </div>

        <hr>

    <div class="card mb-2"  v-for="(review) in book.reviews" :key="review.id">
        <div class="comment-container" style="padding: 10px;">
            <div class="row">
                <div class="col">
                    @<b>{{review.user.username}}</b>
                    <div v-for="(stars, index) in review.stars" :key="index" style="display: inline">
                        <i v-if="getStars(index)" class="fas fa-star rating-star-color"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-end mr-2">
                        <small>{{ review.created_at | moment("dddd, MMMM Do YYYY") }}</small>
                    </div>
                </div>
            </div>
            <div class="comment mt-2">
                <p>{{review.comment}}</p>
            </div>
        </div>
    </div>

    <div v-if="book.reviews == 0">
        This book do not have a reviews yet.
    </div>

    </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user_id'
            ],
        data() {
            return {
                book: [],
                hiddenCommentForm: true,
                successMessage: false,
                review: {
                    book_id: '',
                    user_id: '',
                    stars: '',
                    comment: ''
                },
            }
        },
        
        methods: {
            fetchBook() {
                var slug = window.location.href.split('/').pop();
                fetch('/api/book/' +slug)
                .then(response => response.json())
                .then(data => {
                    this.book = data.data;
                }).catch(function(error) {
                    console.log(error);
                })
            },

            showCommentForm() {
                this.hiddenCommentForm = false;
            },

            hideCommentForm() {
                this.hiddenCommentForm = true;
            },

            getStars(index) {
                return index+1;
            },

            addReview(bookId) {
                axios.post('/api/review', {
                   book_id: bookId,
                   user_id: this.user_id,
                   stars: this.review.stars,
                   comment: this.review.comment,
                   headers: {
                       'content-type' : 'application/json'
                   } 
                })
                .then(data => {
                    this.review.stars = '',
                    this.review.comment = '';
                    this.successMessage = true;
                    this.hideCommentForm();
                    this.fetchBook();
                })
                .catch(function(error) {
                    console.log(error);
                });
            }
        },
        created() {
            this.fetchBook();
        },

        mounted() {

        }
    }
</script>