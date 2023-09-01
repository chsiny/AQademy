<?php

namespace App\Models;

use CodeIgniter\Model;

class Posts_model extends Model
{
    protected $table = 'Posts';
    protected $allowedFields = ['title', 'username', 'datetime', 'content', 'upvotes', 'isComment'];
    
    public function getPosts($start, $limit)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('isComment', 0);
        $builder->orderBy('postId', 'DESC');
        $builder->limit($limit, $start);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function countPosts() {
        return $this->db->table('Posts')->where('isComment', 0)->countAll();
    }

    public function getPost($id)
    {
        $builder = $this->db->table('Posts');
        $builder->select('*');
        $builder->where('postId', $id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function isBookmark($username, $postId)
    {
        $builder = $this->db->table('Bookmarks');
        $builder->select('*');
        $builder->where('username', $username);
        $builder->where('postId', $postId);
        $query = $builder->get();
        $result = $query->getResultArray();
        return count($result) > 0;
    }

    public function bookmark($username, $postId)
    {
        $data = [
            'username' => $username,
            'postId' => $postId
        ];
        $inserted = $this->db->table('Bookmarks')->insert($data);
        return $inserted ? true : false;
    }

    public function getBookmarks($username)
    {
        $builder = $this->db->table('Bookmarks');
        $builder->select('Posts.*');
        $builder->join('Posts', 'Bookmarks.postId = Posts.postId');
        $builder->where('Bookmarks.username', $username);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function deleteBookmark($username, $postId)
    {
        $builder = $this->db->table('Bookmarks');
        $builder->where('username', $username);
        $builder->where('postId', $postId);
        $builder->delete();
    }

    public function upvotePost($id)
    {
        $builder = $this->db->table('Posts');
        $builder->where('postId', $id);
        $builder->set('upvotes', 'upvotes + 1', FALSE);
        $builder->update();
        return;
    }

    public function getComments($postId)
    {
        $builder = $this->db->table('PostsPath');
        $builder->select('Posts.*');
        $builder->join('Posts', 'PostsPath.postId = Posts.postId');
        $builder->where('PostsPath.parentId', $postId);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function createComment($username, $content, $parentId, $datetime)
    {
        $data = [
            'title' => '',
            'username' => $username,
            'datetime' => $datetime,
            'content' => $content,
            'upvotes' => 0,
            'isComment' => 1
        ];
        $this->insert($data);
    
        // Get the ID of the new comment post
        $newPostId = $this->db->insertID();
    
        // Create PostsPath entry
        $data = [
            'postId' => $newPostId,
            'parentId' => $parentId
        ];
        $this->db->table('PostsPath')->insert($data);

    }

    public function searchPosts($search_term) 
    {
        $search_term = $this->db->escapeLikeString($search_term);
        $builder = $this->db->table('Posts');
        // $builder->select('postId, title');
        $builder->select('*');
        $builder->like('title', $search_term);
        // $builder->orLike('content', $search_term);
        $query = $builder->get();
        return $query->getResultArray();
    }
}