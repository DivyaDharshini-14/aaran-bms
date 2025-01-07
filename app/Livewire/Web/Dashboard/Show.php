<?php

namespace App\Livewire\Web\Dashboard;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public $blog;
    public $collectBlog;
    public $blogIndex;
    public $blogCategory;

    public function mount($id)
    {
        $this->blogIndex = $id;
        $this->collectBlog = Http::get('https://cloud.aaranassociates.com/api/v1/blog')->json();
        $this->blog = $this->collectBlog[$id];
        $unique_combinations = [];
        foreach ($this->collectBlog as $value) {
            $key = $value['category_name'] . '|' . $value['blogcategory_id'];
            if (!isset($unique_combinations[$key])) {
                $unique_combinations[$key] = [
                    'category_name' => $value['category_name'],
                    'blogcategory_id' => $value['blogcategory_id']
                ];
            }
        }
        $this->blogCategory = array_values($unique_combinations);
    }


    public function render()
    {
        return view('livewire.web.dashboard.show');
    }
}
