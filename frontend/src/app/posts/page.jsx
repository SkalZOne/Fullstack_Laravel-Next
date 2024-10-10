"use client";

import { useEffect, useState } from "react";

const PostAll = () => {
  const [posts, setPosts] = useState(null);
  const [currentPage, setCurrentPage] = useState(1);

  const fetchData = async () => {
    const response = await fetch(
      `http://127.0.0.1:8000/getAllPosts/?page=${currentPage}`
    ).then((response) => response.json());
    setPosts(response);
  };

  useEffect(() => {
    fetchData();
  }, [currentPage]);

  return (
    <div>
      <div className="grid gap-10 grid-cols-5 mx-3">
        {posts &&
          posts.data.map(({ title, primary_photo, price }, index) => {
            return (
              <ul
                key={index}
                className="flex flex-col text-center border border-t-indigo-600 shadow-xl rounded p-2 max-w-60"
              >
                <li key={title} className="text-2xl">
                  {title}
                </li>
                <li
                  key={primary_photo}
                  className="text-ellipsis overflow-hidden max-w-full"
                >
                  {primary_photo}
                </li>
                <li key={price}>{price}</li>
              </ul>
            );
          })}
      </div>
    </div>
)}

export default PostAll;
