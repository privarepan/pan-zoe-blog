<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PostController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Post::with('user','tag'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user.name','用户');
            $grid->column('title');
            $grid->tag->implode('name','，');
//            $grid->column('content');
            $grid->column('is_recommend')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel()->expand(true);
                $filter->equal('id')->width(3);
                $filter->equal('user_id')->width(3);
                $filter->in('tag.name','标签')->multipleSelect(Tag::pluck('name','name'))->width(3);
                $filter->like('title')->width(3);
                $filter->like('content')->width(3);
                $filter->between('created_at')->datetime()->width(4);

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, Post::with('user'), function (Show $show) {
            $show->field('id');
            $show->field('user.name','用户');
            $show->field('title');
            $show->field('content')->unescape();
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Post(), function (Form $form) {
            $form->display('id');
            $form->hidden('user_id')->default(1);
            $form->text('title');
            $form->editor('content');
            $form->multipleSelect('tag')->options(Tag::pluck('name','id'))->required();
            $form->switch('is_recommend')->default(0);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
