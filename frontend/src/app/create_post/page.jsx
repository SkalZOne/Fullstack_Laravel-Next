"use client";

import { useEffect, useState } from "react";
import axios from "../../../lib/axios";
import Input from "../components/Input";
import Label from "../components/Label";
import Button from "../components/Button";
import Warning from "../images/Warning";
import Link from "next/link";

const CreatePost = () => {
  const [response, setResponse] = useState("");
  const [errors, setErrors] = useState("");
  const [title, setTitle] = useState("");
  const [description, setDescription] = useState("");
  const [primaryPhoto, setPrimaryPhoto] = useState("");
  const [secondaryPhoto, setSecondaryPhoto] = useState("");
  const [thirdPhoto, setThirdPhoto] = useState("");
  const [price, setPrice] = useState("");

  const create = async (
    title,
    description,
    primaryPhoto,
    secondaryPhoto,
    thirdPhoto,
    price
  ) => {
    await axios
      .post(
        `createPost?title=${title}&description=${description}&primary_photo=${primaryPhoto}&secondary_photo=${secondaryPhoto}&third_photo=${thirdPhoto}&price=${price}`
      )
      .then((response) => setResponse(response.data));
  };

  useEffect(() => {
    if (response) {
      if (response.error_messages) {
        setErrors(response.error_messages);
      }
    }
  }, [response]);

  const handleSubmit = (e) => {
    e.preventDefault();
    create(title, description, primaryPhoto, secondaryPhoto, thirdPhoto, price);
  };

  return (
    <div className="flex justify-center items-center min-h-full">
      <form className="flex flex-col gap-6" onSubmit={handleSubmit}>
        {response && response.status == "Created" && (
          <small className="text-center text-indigo-700 font-bold text-sm border-b border-b-indigo-700">
            Post with {response.post_id}ID successfuly created
          </small>
        )}

        {errors &&
          errors.map((error, i) => {
            return (
              <small
                key={i}
                className="flex items-center gap-2 text-[#DB3138] font-extrabold"
              >
                <Warning></Warning>
                {error}
              </small>
            );
          })}

        <div className="flex gap-4">
          <div>
            <Label>Title: </Label>
            <Input
              value={title}
              onInput={(e) => {
                setTitle(e.target.value);
              }}
            />
          </div>

          <div>
            <Label>Description: </Label>
            <Input
              value={description}
              onInput={(e) => {
                setDescription(e.target.value);
              }}
            />
          </div>

          <div>
            <Label>Price: </Label>
            <Input
              value={price}
              onInput={(e) => {
                setPrice(e.target.value);
              }}
            />
          </div>
        </div>

        <div className="flex gap-4">
          <div>
            <Label>Primary photo URL: </Label>
            <Input
              value={primaryPhoto}
              onInput={(e) => {
                setPrimaryPhoto(e.target.value);
              }}
            />
          </div>

          <div>
            <Label>Secondary photo URL: </Label>
            <Input
              value={secondaryPhoto}
              onInput={(e) => {
                setSecondaryPhoto(e.target.value);
              }}
            />
          </div>

          <div>
            <Label>Third photo URL: </Label>
            <Input
              value={thirdPhoto}
              onInput={(e) => {
                setThirdPhoto(e.target.value);
              }}
            />
          </div>
        </div>
        <Button className="flex justify-center" type="submit">
          Submit
        </Button>
        <Link
          className="px-4 py-2 text-center text-xs font-semibold uppercase tracking-widest rounded border-b border-b-indigo-700 transition-colors hover:bg-indigo-700 hover:text-white"
          href="/"
        >
          Back
        </Link>
      </form>
    </div>
  );
};

export default CreatePost;
