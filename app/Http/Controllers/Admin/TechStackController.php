<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    private function getIcons()
    {
        return [
            // Programming Languages
            'fa-brands fa-php' => 'PHP',
            'fa-brands fa-js' => 'JavaScript',
            'fa-brands fa-python' => 'Python',
            'fa-brands fa-java' => 'Java',
            'fa-brands fa-html5' => 'HTML5',
            'fa-brands fa-css3-alt' => 'CSS3',
            'fa-brands fa-rust' => 'Rust',
            'fa-brands fa-golang' => 'Go',
            'fa-brands fa-swift' => 'Swift',

            // Frameworks & Libraries
            'fa-brands fa-laravel' => 'Laravel',
            'fa-brands fa-react' => 'React',
            'fa-brands fa-vuejs' => 'Vue.js',
            'fa-brands fa-angular' => 'Angular',
            'fa-brands fa-node' => 'Node.js',
            'fa-brands fa-node-js' => 'NodeJS (Alt)',
            'fa-brands fa-bootstrap' => 'Bootstrap',
            'fa-brands fa-sass' => 'Sass',
            'fa-brands fa-wordpress' => 'WordPress',
            'fa-brands fa-symfony' => 'Symfony',

            // Database & Cloud
            'fa-solid fa-database' => 'Database (Generic)',
            'fa-brands fa-aws' => 'AWS',
            'fa-brands fa-docker' => 'Docker',
            'fa-brands fa-digital-ocean' => 'Digital Ocean',
            'fa-brands fa-google' => 'Google Cloud',
            'fa-brands fa-microsoft' => 'Azure (Microsoft)',
            'fa-brands fa-cloudflare' => 'Cloudflare',

            // Tools & OS
            'fa-brands fa-git' => 'Git',
            'fa-brands fa-github' => 'GitHub',
            'fa-brands fa-gitlab' => 'GitLab',
            'fa-brands fa-bitbucket' => 'Bitbucket',
            'fa-brands fa-linux' => 'Linux',
            'fa-brands fa-ubuntu' => 'Ubuntu',
            'fa-brands fa-windows' => 'Windows',
            'fa-brands fa-apple' => 'macOS',
            'fa-brands fa-android' => 'Android',
            'fa-brands fa-figma' => 'Figma',
            'fa-brands fa-sketch' => 'Sketch',
            'fa-brands fa-jira' => 'Jira',
            'fa-brands fa-trello' => 'Trello',
            'fa-brands fa-slack' => 'Slack',
            'fa-brands fa-discord' => 'Discord',
            'fa-brands fa-stack-overflow' => 'Stack Overflow',
            'fa-brands fa-npm' => 'NPM',
            'fa-brands fa-yarn' => 'Yarn',
            'fa-brands fa-markdown' => 'Markdown',
            
            // Others
            'fa-solid fa-code' => 'Code (Generic)',
            'fa-solid fa-terminal' => 'Terminal',
            'fa-solid fa-server' => 'Server',
            'fa-solid fa-microchip' => 'Hardware',
        ];
    }

    public function index()
    {
        $techStacks = TechStack::orderBy('sort_order')->get();
        return view('admin.tech_stacks.index', compact('techStacks'));
    }

    public function create()
    {
        $icons = $this->getIcons();
        return view('admin.tech_stacks.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['active'] = $request->has('active');

        TechStack::create($validated);

        return redirect()->route('admin.tech-stacks.index')
            ->with('success', 'Tech stack added successfully.');
    }

    public function edit(TechStack $techStack)
    {
        $icons = $this->getIcons();
        return view('admin.tech_stacks.edit', compact('techStack', 'icons'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['active'] = $request->has('active');

        $techStack->update($validated);

        return redirect()->route('admin.tech-stacks.index')
            ->with('success', 'Tech stack updated successfully.');
    }

    public function destroy(TechStack $techStack)
    {
        $techStack->delete();
        return redirect()->route('admin.tech-stacks.index')
            ->with('success', 'Tech stack deleted successfully.');
    }
}
