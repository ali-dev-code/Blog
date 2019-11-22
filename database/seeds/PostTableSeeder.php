<?php
use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Hash;



use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


      $category1 = Category::create([

        'name'=> 'news1'
      ]);

      $author1 = App\User::create([
        'name'=> 'ali',
        'email'=> 'aliasghar@gmail.com',
        'password'=> Hash::make('password')
      ]);
      $author2 = App\User::create([
        'name'=> 'taskeen',
        'email'=> 'taskeen@gmail.com',
        'password'=> Hash::make('password')
      ]);

      $category2 = Category::create([

        'name'=> 'marketing'
      ]);

      $category3 = Category::create([

        'name'=> 'Partnership'
      ]);


     $post1 = Post::create([

     'title'=> 'We relocated our office to a new designed garage',
     'description'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
     'content'=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
       It has survived not only five centuries',

       'category_id'=> $category1->id,
       'image'=> 'posts/one.jpg',
       'user_id'=> $author1->id

     ]);

     $post2 = Post::create([

     'title'=> 'Top 5 brilliant content marketing strategies',
     'description'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
     'content'=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
       It has survived not only five centuries',

       'category_id'=> $category2->id,
       'image'=> 'posts/three.jpg',
       'user_id'=> $author2->id

     ]);

     $post3 = Post::create([

     'title'=> 'Best practices for minimalist design with example',
     'description'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
     'content'=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
       It has survived not only five centuries',

       'category_id'=> $category3->id,
       'image'=> 'posts/two.jpg',
       'user_id'=> $author2->id

     ]);

     $post4 = Post::create([

     'title'=> 'Congratulate and thank to Maryam for joining our team',
     'description'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
     'content'=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
       It has survived not only five centuries',

       'category_id'=> $category2->id,
       'image'=> 'posts/one.jpg',
       'user_id'=> $author1->id

     ]);

     $tag1 = Tag::create([

       'name'=> 'job'
     ]);

     $tag2 = Tag::create([

       'name'=> 'Customers'
     ]);

     $tag3 = Tag::create([

       'name'=> 'Record'
     ]);


  $post1->tags()->attach([$tag1->id , $tag2->id]);

  $post2->tags()->attach([$tag2->id , $tag3->id]);

  $post3->tags()->attach([$tag1->id , $tag3->id]);







   } // end of run function

}
