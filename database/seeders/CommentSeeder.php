<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('username', 'ichiro_')->first();
        $user2 = User::where('username', 'jperez_87')->first();
        $user3 = User::where('username', 'jaime3899')->first();
        $user4 = User::where('username', 'tony_mountain2')->first();
        $user5 = User::where('username', 'pau_pm')->first();
        $user6 = User::where('username', 'marta_train02')->first();

        $post1 = Post::find(16);
        $post2 = Post::find(19);
        $post3 = Post::find(20);
        $post4 = Post::find(18);
        $post5 = Post::find(17);
        $post6 = Post::find(21);

        $comment1 = Comment::create([
            'user_id' => $user1->id,
            'post_id' => $post1->id,
            'content' => 'Buenas, ¿para llegar a la ruta se puede acceder bien en coche?',
        ]);

        Comment::create([
            'user_id' => $user3->id,
            'post_id' => $post2->id,
            'content' => '¡Me encanta esa etapa en primavera!',
        ]);

        Comment::create([
            'user_id' => $user6->id,
            'post_id' => $post2->id,
            'content' => 'Me la apunto, algun dia tengo que empezar el camino de Santiago :)',
        ]);

        $comment2 = Comment::create([
            'user_id' => $user4->id,
            'post_id' => $post3->id,
            'content' => 'Vamos a subirlo en invierno, ¿son necesarios crampones para el hielo?',
        ]);

        Comment::create([
            'user_id' => $user5->id,
            'post_id' => $post3->id,
            'parent_id' => $comment2->id,
            'content' => 'Es obligatorio subir con crampones en invierno, hay zonas de barranco y se forma bastante hielo cerca de la cumbre.',
        ]);

        Comment::create([
            'user_id' => $user2->id,
            'post_id' => $post6->id,
            'content' => 'Buen post!',
        ]);

        Comment::create([
            'user_id' => $user2->id,
            'post_id' => $post4->id,
            'parent_id' => $comment1->id,
            'content' => 'Se puede aparcar justo al comenzar la ruta, la subida al parking es por carretera.',
        ]);

        Comment::create([
            'user_id' => $user5->id,
            'post_id' => $post5->id,
            'content' => 'Tiene que ser increible subir en verano',
        ]);

        Comment::create([
            'user_id' => $user3->id,
            'post_id' => $post5->id,
            'content' => 'Yo hice el ascenso por la cara norte, probaré tu ruta a ver que tal',
        ]);
    }
}
