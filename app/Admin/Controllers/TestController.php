<?php

namespace App\Admin\Controllers;

use App\Models\Recipe;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recipe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Recipe());

        $grid->column('id', __('Id'));
        $grid->column('user_token', __('User token'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('ingredients', __('Ingredients'));
        $grid->column('instructions', __('Instructions'));
        $grid->column('cooking_time', __('Cooking time'));
        $grid->column('thumbnail', __('Thumbnail'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Recipe::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_token', __('User token'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('ingredients', __('Ingredients'));
        $show->field('instructions', __('Instructions'));
        $show->field('cooking_time', __('Cooking time'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Recipe());

        $form->text('user_token', __('User token'));
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->textarea('ingredients', __('Ingredients'));
        $form->textarea('instructions', __('Instructions'));
        $form->number('cooking_time', __('Cooking time'));
        $form->text('thumbnail', __('Thumbnail'));

        return $form;
    }
}
