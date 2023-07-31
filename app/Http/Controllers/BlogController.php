<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    // Mostrar el formulario de nuevo blog
    public function showForm()
    {
        return view('formulario_nuevo_blog');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('detalle_blog', ['blog' => $blog]);
    }

    // Guardar el nuevo blog en la base de datos
    public function store(Request $request)
    {
        $nuevoBlog = new Blog();
        $nuevoBlog->titulo = $request->input('titulo');
        $nuevoBlog->contenido = $request->input('contenido');
        $nuevoBlog->fecha_publicacion = now();
        $nuevoBlog->autor = $request->input('autor');
        $nuevoBlog->save();

        return redirect('/'); // Redirigir a la página del blog después de guardar el blog
    }

    // Mostrar el formulario de edición de blog
    public function showEditForm($id)
    {
        $blog = Blog::findOrFail($id);
        return view('formulario_editar_blog', ['blog' => $blog]);
    }

    // Actualizar el blog en la base de datos
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->titulo = $request->input('titulo');
        $blog->contenido = $request->input('contenido');
        $blog->save();

        return redirect('/blogs/' . $id); // Redirigir al detalle del blog después de actualizar
    }
}
