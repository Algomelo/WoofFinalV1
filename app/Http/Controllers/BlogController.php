<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{



    public function create()
    {
        return view('blogs.create');
    }

    public function index(){
        $blog = Blog::all();
        return view('blogs.index', compact('blog'));

    }

    // Mostrar el formulario de nuevo blog



    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }


    public function showForm()
    {
        return view('blogs.create');
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
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $imagePath = $request->file('image_path')->store('uploads', 'public');
            $nuevoBlog->image_path = $imagePath;
        }
        $nuevoBlog->save();



        return redirect('/blogs'); // Redirigir a la página del blog después de guardar el blog
    }

    // Mostrar el formulario de edición de blog
    public function showEditForm($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', ['blog' => $blog]);
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
