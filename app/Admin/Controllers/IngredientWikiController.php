<?php

namespace App\Admin\Controllers;

use App\Models\IngredientWiki;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IngredientWikiController extends AdminController
{

    protected function grid()
    {
        $grid = new Grid(new IngredientWiki());
        $grid->column('name', __('Name'));
        $grid->column('thumbnail', __('Thumbnail'))->image('/uploads/', 50, 50);;
        $grid->column('description', __('Description'));
        $grid->column('seasonality', __('Seasonality'));
        $grid->column('storage', __('Storage'));
        $grid->column('cooking_tips', __('Cooking Tips'));
        $grid->column('health_benefits', __('Health Benefits'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(IngredientWiki::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('description', __('Description'));
        $show->field('seasonality', __('Seasonality'));
        $show->field('storage', __('Storage'));
        $show->field('cooking_tips', __('Cooking Tips'));
        $show->field('health_benefits', __('Health Benefits'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new IngredientWiki());

        $form->text('name', __('Name'));
        $form->image('thumbnail', __('Thumbnail'))->uniqueName();
        $form->text('description', __('Description'));
        $form->text('seasonality', __('Seasonality'));
        $form->text('storage', __('Storage'));
        $form->text('cooking_tips', __('Cooking Tips'));
        $form->text('health_benefits', __('Health Benefits'));

        return $form;
    }
}
