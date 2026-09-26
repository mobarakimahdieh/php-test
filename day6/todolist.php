<?php

class TodoList
{
    private string $file = 'todos.json';

    private function read(): array
    {
        $data = file_get_contents($this->file);

        return json_decode($data, true) ?? [];
    }

    private function write(array $todos): void
    {
        file_put_contents(
            $this->file,
            json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    public function all(): array
    {
        return $this->read();
    }

    public function add($title): void
    {
        $todos = $this->read();

        $ids = array_column($todos, 'id');

        $newId = empty($ids) ? 1 : max($ids) + 1;

        $todos[] = [
            'id' => $newId,
            'title' => trim($title),
            'done' => false
        ];

        $this->write($todos);
    }

    public function update($id, $title): void
    {
        $todos = $this->read();

        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['title'] = trim($title);
                break;
            }
        }

        $this->write($todos);
    }

    public function delete($id): void
    {
        $todos = $this->read();

        $todos = array_filter($todos, function ($todo) use ($id) {
            return $todo['id'] != $id;
        });

        $this->write(array_values($todos));
    }

    public function toggle($id): void
    {
        $todos = $this->read();

        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['done'] = !$todo['done'];
                break;
            }
        }

        $this->write($todos);
    }
}